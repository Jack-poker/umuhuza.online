self.addEventListener('push', function(event) {
    if (event.data) {
        try {
            const data = event.data.json();
            const options = {
                body: data.body || 'You have a new notification',
                icon: '/assets/images/logo.png', // Assuming there's a logo
                badge: '/assets/images/badge.png',
                data: {
                    url: data.url || '/'
                }
            };
            event.waitUntil(self.registration.showNotification(data.title || 'UMUHUZA Alert', options));
        } catch (e) {
            event.waitUntil(self.registration.showNotification('UMUHUZA Alert', { body: event.data.text() }));
        }
    }
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function(clientList) {
            const urlToOpen = new URL(event.notification.data.url, self.location.origin).href;
            for (let i = 0; i < clientList.length; i++) {
                const client = clientList[i];
                if (client.url === urlToOpen && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(urlToOpen);
            }
        })
    );
});
