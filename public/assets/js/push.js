function urlB64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

async function initWebPush() {
    if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
        console.warn('Web Push is not supported in this browser.');
        return;
    }

    try {
        const registration = await navigator.serviceWorker.register('/sw.js');
        console.log('Service Worker registered successfully');

        const permission = await window.Notification.requestPermission();
        if (permission !== 'granted') {
            console.warn('Notification permission denied');
            return;
        }

        if (!window.VAPID_PUBLIC_KEY) {
            console.error('VAPID_PUBLIC_KEY is not defined.');
            return;
        }

        let subscription = await registration.pushManager.getSubscription();
        if (!subscription) {
            const applicationServerKey = urlB64ToUint8Array(window.VAPID_PUBLIC_KEY);
            subscription = await registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: applicationServerKey
            });
        }

        // Send subscription to server
        await fetch('?route=push-subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(subscription)
        });

        console.log('Push subscription saved successfully');

    } catch (error) {
        console.error('Error during Service Worker / Push registration:', error);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initWebPush);
