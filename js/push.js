firebase.initializeApp({
    messagingSenderId: '1037617074889'
});

if (
    'Notification' in window &&
    'serviceWorker' in navigator &&
    'localStorage' in window &&
    'fetch' in window &&
    'postMessage' in window
) {
    var messaging = firebase.messaging();

    // already granted
    if (Notification.permission === 'granted' && localStorage.getItem('notifications') == 1) {
       $('#pushes-toggle').attr('checked', 'checked');
    }

    // get permission on subscribe only once
    $(document).on('change', '#pushes-toggle', function() {
        if ($(this).is(':checked')) {
            getToken();
        }
        else{
         messaging.getToken()
            .then(function(currentToken) {
                messaging.deleteToken(currentToken)
                    .then(function() {
                        console.log('Token deleted');
                        setTokenSentToServer(false);
                        $.post('fc/save-push-token.php', {token: currentToken, type: "delete"});
                        localStorage.setItem('notifications', 0);
                        // Once token is deleted update UI.
                    })
                    .catch(function(error) {
                        showError('Не получилось удалить токен', error);
                    });
            })
            .catch(function(error) {
                console.log('Произошла ошыбка', error);
            });
        }
    });

    // setInterval(function(){
    //     if (localStorage.getItem('notification_got') == 1) {
    //         localStorage.setItem('notification_got', 0);
    //     }
    // },1000);

    // handle catch the notification on current page
    messaging.onMessage(function(payload) {
        console.log('Message received', payload);

        // register fake ServiceWorker for show notification on mobile devices
        navigator.serviceWorker.register('../firebase-messaging-sw.js');
        Notification.requestPermission(function(permission) {
            if (permission === 'granted') {
                navigator.serviceWorker.ready.then(function(registration) {
                  // Copy data object to get parameters in the click handler
                  payload.data.data = JSON.parse(JSON.stringify(payload.data));

                  //if (localStorage.getItem('notification_got') != 1) {
                        registration.showNotification(payload.data.title, payload.data);
                        //localStorage.setItem('notification_got', 1);
                  //}
                }).catch(function(error) {
                    // registration failed :(
                    showError('Не удалось зарегать sw', error);
                });
            }
        });
    });

    // Callback fired if Instance ID token is updated.
    messaging.onTokenRefresh(function() {
        messaging.getToken()
            .then(function(refreshedToken) {
                console.log('Token refreshed');
                // Send Instance ID token to app server.
                sendTokenToServer(refreshedToken);
            })
            .catch(function(error) {
                showError('Не получилось обновить токен', error);
            });
    });

} else {
    // if (!('Notification' in window)) {
    //     showError('Notification not supported');
    // } else if (!('serviceWorker' in navigator)) {
    //     showError('ServiceWorker not supported');
    // } else if (!('localStorage' in window)) {
    //     showError('LocalStorage not supported');
    // } else if (!('fetch' in window)) {
    //     showError('fetch not supported');
    // } else if (!('postMessage' in window)) {
    //     showError('postMessage not supported');
    // }

    console.warn('This browser does not support desktop notification.');
    console.log('Is HTTPS', window.location.protocol === 'https:');
    console.log('Support Notification', 'Notification' in window);
    console.log('Support ServiceWorker', 'serviceWorker' in navigator);
    console.log('Support LocalStorage', 'localStorage' in window);
    console.log('Support fetch', 'fetch' in window);
    console.log('Support postMessage', 'postMessage' in window);
    $('#pushes-toggle').parent().parent().parent().hide();
}


function getToken() {
    messaging.requestPermission()
        .then(function() {
            // Get Instance ID token. Initially this makes a network call, once retrieved
            // subsequent calls to getToken will return from cache.
            messaging.getToken()
                .then(function(currentToken) {

                    if (currentToken) {
                        sendTokenToServer(currentToken);
                        //updateUIForPushEnabled(currentToken);
                    } else {
                        showError('Что-то пошло не так :(');
                        $('#pushes-toggle').click();
                        //updateUIForPushPermissionRequired();
                        setTokenSentToServer(false);
                    }
                })
                .catch(function(error) {
                    showError('Что-то пошло не так :(', error);
                    //updateUIForPushPermissionRequired();
                    setTokenSentToServer(false);
                });
        })
        .catch(function(error) {
            $('#pushes-toggle').click();
            showError('Вы заблокировали уведомления на сайте. Включите самостоятельно в настройках', error);
        });
}

// Send the Instance ID token your application server, so that it can:
// - send messages back to this app
// - subscribe/unsubscribe the token from topics
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer(currentToken)) {
        console.log('Sent token to server');
        // send current token to server
        $.post('fc/save-push-token.php', {token: currentToken, type: "add"});
        localStorage.setItem('notifications', 1);
        setTokenSentToServer(currentToken);
    } else {
        console.log('Token already sent to server so won\'t send it again unless it changes');
    }
}

function isTokenSentToServer(currentToken) {
    return window.localStorage.getItem('sentFirebaseMessagingToken') === currentToken;
}

function setTokenSentToServer(currentToken) {
    if (currentToken) {
        window.localStorage.setItem('sentFirebaseMessagingToken', currentToken);
    } else {
        window.localStorage.removeItem('sentFirebaseMessagingToken');
    }
}

function showError(error, error_data) {
    if (typeof error_data !== "undefined") {
        console.error(error, error_data);
    } else {
        console.error(error);
    }
    alert(error);
}