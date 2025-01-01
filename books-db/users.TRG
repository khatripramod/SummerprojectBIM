TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER update_user_updated_at\nBEFORE UPDATE ON users\nFOR EACH ROW\nBEGIN\n    SET NEW.updated_at = NOW();\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=171161518509
