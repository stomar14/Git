CREATE DATABASE IF NOT EXISTS Reservations;
GO
USE Reservations;
CREATE TABLE IF NOT EXISTS available (
									id int(11) NOT NULL AUTO_INCREMENT,
									roomnum varchar(50) NOT NULL,
					avail int(11) NOT NULL,
					prosjektor varchar(3) NOT NULL,
					etasje int(11) NOT NULL,
					storrelse int(11) NOT NULL,
					PRIMARY KEY(id)
					);
GO
CREATE TABLE IF NOT EXISTS confirms (
								id int(11) NOT NULL AUTO_INCREMENT,
								roomnum varchar(50) NOT NULL,
								start_date datetime NOT NULL,
								end_date datetime NOT NULL,
								navn varchar(50) NOT NULL,
								PRIMARY KEY (id)
								);
GO
INSERT INTO available (roomnum, avail, prosjektor, etasje, storrelse)
								VALUES ('Rom 1', 1, 0, 1, 2),
								('Rom 2', 1, 1, 1, 3),
								('Rom 3', 1, 0, 1, 4),
								('Rom 4', 1, 1, 1, 4),
								('Rom 5', 1, 0, 1, 3),
								('Rom 6', 1, 1, 1, 2),
								('Rom 7', 1, 0, 1, 2),
								('Rom 8', 1, 1, 1, 3),
								('Rom 9', 1, 0, 1, 4),
								('Rom 10', 1, 1, 1, 4),
								('Rom 11', 1, 0, 2, 3),
								('Rom 12', 1, 1, 2, 2),
								('Rom 13', 1, 0, 2, 2),
								('Rom 14', 1, 1, 2, 3),
								('Rom 15', 1, 0, 2, 4),
								('Rom 16', 1, 1, 2, 4),
								('Rom 17', 1, 0, 2, 3),
								('Rom 18', 1, 1, 2, 2),
								('Rom 19', 1, 0, 2, 2),
								('Rom 20', 1, 1, 2, 3);