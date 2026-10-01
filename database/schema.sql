CREATE DATABASE IF NOT EXISTS rwanda_marketplace;
USE rwanda_marketplace;

CREATE TABLE IF NOT EXISTS plans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL DEFAULT 0,
  duration_months INT NOT NULL DEFAULT 1,
  listing_limit INT NOT NULL DEFAULT 5,
  featured TINYINT(1) NOT NULL DEFAULT 0,
  ranking_priority INT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  username VARCHAR(80) NOT NULL UNIQUE,
  phone VARCHAR(30) NOT NULL,
  whatsapp VARCHAR(30) NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('client','provider','admin') NOT NULL DEFAULT 'client',
  account_type VARCHAR(30) NOT NULL DEFAULT 'agent',
  service_category VARCHAR(100) NULL,
  province VARCHAR(100) NULL,
  district VARCHAR(100) NULL,
  sector VARCHAR(100) NULL,
  cell VARCHAR(100) NULL,
  village VARCHAR(100) NULL,
  profile_image VARCHAR(255) NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_users_role (role)
);

CREATE TABLE IF NOT EXISTS user_plans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  plan_id INT NOT NULL,
  starts_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ends_at TIMESTAMP NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'active',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS provinces (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS districts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  province_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  FOREIGN KEY (province_id) REFERENCES provinces(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS sectors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  district_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  FOREIGN KEY (district_id) REFERENCES districts(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cells (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sector_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  FOREIGN KEY (sector_id) REFERENCES sectors(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS service_areas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  area VARCHAR(160) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  INDEX idx_service_areas_user (user_id)
);

CREATE TABLE IF NOT EXISTS listings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  category_id INT NOT NULL,
  title VARCHAR(160) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(12,2) NOT NULL DEFAULT 0,
  province VARCHAR(100) NOT NULL,
  district VARCHAR(100) NOT NULL,
  sector VARCHAR(100) NOT NULL,
  cell VARCHAR(100) NOT NULL,
  plan_id INT NOT NULL DEFAULT 1,
  status VARCHAR(30) NOT NULL DEFAULT 'pending',
  rating DECIMAL(2,1) NOT NULL DEFAULT 4.5,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
  FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE,
  INDEX idx_listing_status (status),
  INDEX idx_listing_plan (plan_id)
);

CREATE TABLE IF NOT EXISTS listing_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  listing_id INT NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (listing_id) REFERENCES listings(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  whatsapp VARCHAR(30) NULL,
  province VARCHAR(100) NULL,
  district VARCHAR(100) NULL,
  sector VARCHAR(100) NULL,
  budget DECIMAL(12,2) NULL,
  description TEXT NOT NULL,
  type VARCHAR(50) NOT NULL DEFAULT 'service',
  status VARCHAR(30) NOT NULL DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS request_matches (
  id INT AUTO_INCREMENT PRIMARY KEY,
  request_id INT NOT NULL,
  provider_id INT NOT NULL,
  match_level INT NOT NULL DEFAULT 1,
  priority_score INT NOT NULL DEFAULT 0,
  status VARCHAR(30) NOT NULL DEFAULT 'delivered',
  delivered_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (request_id) REFERENCES requests(id) ON DELETE CASCADE,
  FOREIGN KEY (provider_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS listing_views (
  id INT AUTO_INCREMENT PRIMARY KEY,
  listing_id INT NOT NULL,
  user_ip VARCHAR(100) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (listing_id) REFERENCES listings(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS listing_contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  listing_id INT NOT NULL,
  contact_type VARCHAR(30) NOT NULL,
  customer_phone VARCHAR(30) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (listing_id) REFERENCES listings(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  plan_id INT NOT NULL,
  transaction_id VARCHAR(100) NULL,
  sender_name VARCHAR(120) NULL,
  sender_phone VARCHAR(30) NULL,
  amount DECIMAL(12,2) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'pending',
  method VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  approved_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  message TEXT NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  is_archived TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS verification_requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'pending',
  note TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS admin_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT NOT NULL,
  action VARCHAR(100) NOT NULL,
  entity_type VARCHAR(50) NOT NULL,
  entity_id INT NOT NULL,
  old_value TEXT NULL,
  new_value TEXT NULL,
  reason TEXT NULL,
  ip_address VARCHAR(45) NULL,
  user_agent VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO plans (name, price, duration_months, listing_limit, featured, ranking_priority) VALUES
('Free', 0, 1, 5, 0, 1),
('Premium', 3000, 1, 20, 1, 2),
('Super', 5000, 1, 9999, 1, 3)
ON DUPLICATE KEY UPDATE name=VALUES(name), price=VALUES(price);

INSERT INTO categories (name, slug) VALUES
('Real Estate', 'real-estate'),
('Technical Service', 'technical-service'),
('Construction', 'construction')
ON DUPLICATE KEY UPDATE name=VALUES(name);

INSERT INTO provinces (name) VALUES
('Kigali'),
('Southern'),
('Western'),
('Northern'),
('Eastern')
ON DUPLICATE KEY UPDATE name=VALUES(name);

-- Sample demo users (password hash = bcrypt of 'password123')
-- Admin account
INSERT INTO users (id, full_name, username, phone, email, password_hash, role, account_type, province, district, status) VALUES
(1, 'Admin UMUHUZA', 'admin', '+250788000001', 'admin@umuhuza.online', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'agent', 'Kigali', 'Gasabo', 'active')
ON DUPLICATE KEY UPDATE full_name=VALUES(full_name);

-- Sample client
INSERT INTO users (id, full_name, username, phone, email, password_hash, role, account_type, province, district, status) VALUES
(2, 'Jean Pierre Habimana', 'jeanpierre', '+250788111001', 'jeanpierre@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'agent', 'Kigali', 'Gasabo', 'active')
ON DUPLICATE KEY UPDATE full_name=VALUES(full_name);

-- Sample provider
INSERT INTO users (id, full_name, username, phone, email, password_hash, role, account_type, province, district, status) VALUES
(3, 'Kigali Realty Hub', 'kigalirealty', '+250788222001', 'info@kigalirealty.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'provider', 'agent', 'Kigali', 'Gasabo', 'active')
ON DUPLICATE KEY UPDATE full_name=VALUES(full_name);

-- Sample listings
INSERT INTO listings (user_id, category_id, title, description, price, province, district, sector, cell, plan_id, status) VALUES
(3, 1, 'Modern 2-Bedroom Apartment in Kigali', 'Spacious modern apartment with great views, located in a quiet neighborhood. Includes parking and 24/7 security.', 350000, 'Kigali', 'Gasabo', 'Remera', 'Rukiri I', 1, 'approved'),
(3, 3, 'Office Renovation Services', 'Professional office renovation and interior design services. Quality materials and experienced team.', 0, 'Kigali', 'Nyarugenge', 'Muhima', 'Muhima', 1, 'approved')
ON DUPLICATE KEY UPDATE title=VALUES(title);

-- Sample user plan
INSERT INTO user_plans (user_id, plan_id, status) VALUES
(3, 1, 'active')
ON DUPLICATE KEY UPDATE status=VALUES(status);
