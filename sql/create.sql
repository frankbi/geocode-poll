CREATE TABLE geo_korm_07012014
(

	id int NOT NULL AUTO_INCREMENT,
	ans VARCHAR(4),
	ip VARCHAR(100),
	country_code VARCHAR(100),
	region_code VARCHAR(100),
	region_name VARCHAR(100),
	city VARCHAR(100),
	latitude VARCHAR(50),
	longitude VARCHAR(50),
	metro_code VARCHAR(10),
	area_code VARCHAR(10),
	PRIMARY KEY (id)

);