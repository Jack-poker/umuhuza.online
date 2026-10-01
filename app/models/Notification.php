<?php

class NotificationModel {
    public static function create($pdo, $userId, $message, $requestId = null) {
        $stmt = $pdo->prepare('INSERT INTO notifications (user_id, request_id, message, is_read) VALUES (?, ?, ?, 0)');
        return $stmt->execute([$userId, $requestId, $message]);
    }

    public static function all($pdo, $userId) {
        $stmt = $pdo->prepare('
            SELECT n.*, 
                   r.name AS client_name, 
                   r.phone AS client_phone, 
                   r.whatsapp AS client_whatsapp, 
                   r.province AS client_province, 
                   r.district AS client_district, 
                   r.sector AS client_sector, 
                   r.budget AS client_budget, 
                   r.description AS client_description, 
                   r.type AS client_type,
                   r.status AS request_status,
                   r.created_at AS request_created_at
            FROM notifications n
            LEFT JOIN requests r ON r.id = n.request_id
            WHERE n.user_id = ? 
            ORDER BY n.created_at DESC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function unreadCount($pdo, $userId) {
        $stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM notifications WHERE user_id = ? AND is_read = 0');
        $stmt->execute([$userId]);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    public static function markAllRead($pdo, $userId) {
        $stmt = $pdo->prepare('UPDATE notifications SET is_read = 1 WHERE user_id = ?');
        return $stmt->execute([$userId]);
    }
}

