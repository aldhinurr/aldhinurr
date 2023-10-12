
-- building
-- create permissions
INSERT INTO permissions
(name, guard_name, created_at, updated_at)
values
('create building', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('read building', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('update building', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('delete building', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59')
;

-- assign permissions to roles 
insert into role_has_permissions  (permission_id,role_id)
select 
	p.id, r.id 
from roles r, permissions p 
where r.name in ('superadmin', 'admin') and p.name like '%building';
;

-- floor
-- create permissions
INSERT INTO permissions
(name, guard_name, created_at, updated_at)
values
('create floor', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('read floor', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('update floor', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('delete floor', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59')
;

-- assign permissions to roles 
insert into role_has_permissions  (permission_id,role_id)
select 
	p.id, r.id 
from roles r, permissions p 
where r.name in ('superadmin', 'admin') and p.name like '%floor';
;

-- repair_service
-- create permissions
INSERT INTO permissions
(name, guard_name, created_at, updated_at)
values
('create repair_service', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('read repair_service', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('update repair_service', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59'),
('delete repair_service', 'web', '2023-07-31 05:59:59', '2023-07-31 05:59:59')
;

-- assign permissions to roles 
insert into role_has_permissions  (permission_id,role_id)
select 
	p.id, r.id 
from roles r, permissions p 
where r.name in ('superadmin', 'admin') and p.name like '%repair_service';
;

-- db_simora_v2.buildings definition

CREATE TABLE `buildings` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('AKTIF','TIDAK AKTIF','DIHAPUS') NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- db_simora_v2.floors definition

CREATE TABLE `floors` (
  `id` char(36) NOT NULL,
  `building_id` char(36) NOT NULL,
  `number` int(11) NOT NULL,
  `floor_classification` varchar(20) NOT NULL,
  `room_classification` varchar(100) NOT NULL,
  `room_description` varchar(200) NOT NULL,
  `large` double(8,2) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `status` enum('AKTIF','TIDAK AKTIF','DIHAPUS') NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `floors_building_id_index` (`building_id`),
  CONSTRAINT `floors_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- db_simora_v2.repair_services definition

CREATE TABLE `repair_services` (
  `id` char(36) NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Baru',
  `unit` varchar(100) DEFAULT NULL,
  `total` double(12,2) DEFAULT 0.00,
  `attachment` text DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `processed_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- db_simora_v2.repair_service_details definition

CREATE TABLE `repair_service_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `repair_service_id` char(36) NOT NULL,
  `floor_id` char(36) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cost` double(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repair_service_details_repair_service_id_index` (`repair_service_id`),
  KEY `repair_service_details_floor_id_index` (`floor_id`),
  CONSTRAINT `repair_service_details_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `repair_service_details_repair_service_id_foreign` FOREIGN KEY (`repair_service_id`) REFERENCES `repair_services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
