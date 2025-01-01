TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER update_seller_revenue\nAFTER UPDATE ON orders\nFOR EACH ROW\nBEGIN\n    IF NEW.status = \'complete\' THEN\n        UPDATE sellers s\n        SET s.revenue_generated = s.revenue_generated + NEW.prices\n        WHERE s.username = NEW.seller_username;\n    END IF;\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=171586690366
