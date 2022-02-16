-- Création d'une vue : adresses françaises
USE colombes
;

-- Etape 1 : requête
SELECT a.address, 
		a.district, 
        a.postal_code,
        c.city,
        co.country
FROM address a JOIN city c ON a.city_id = c.city_id
			JOIN country co ON c.country_id = co.country_id
WHERE co.country_id = 34
;

-- Etape 2 : création vue
CREATE VIEW adresses_fr AS
SELECT a.address, 
		a.district, 
        a.postal_code,
        c.city,
        co.country
FROM address a JOIN city c ON a.city_id = c.city_id
			JOIN country co ON c.country_id = co.country_id
WHERE co.country_id = 34
;

-- Etape 3 : appel vue
SELECT *
FROM adresses_fr
;

-- Tables systèmes
USE information_schema
;

SHOW tables
;

-- Table système des tables
SELECT t.table_name, 
		t.table_type, 
        t.table_rows, 
        t.create_time
FROM information_schema.tables t
WHERE table_schema = 'colombes'
AND table_type IN ('BASE TABLE', 'VIEW')
;

-- Table système des colonnes
SELECT c.table_schema,
		c.table_name,
        c.column_name,
        c.column_key
FROM information_schema.columns c
WHERE table_schema = 'colombes'
AND c.column_key = 'PRI'
;

-- Tables avec plus d'une colonne PK
SELECT table_name
FROM information_schema.columns
WHERE table_schema = 'colombes'
AND column_key = 'PRI'
GROUP BY table_schema, table_name
HAVING COUNT(*) > 1
;
-- Liste des tables et vues avec une seule PK
SELECT t.table_name, 
		t.table_type, 
        t.table_rows, 
        t.create_time,
        c.column_name,
        c.column_key
FROM information_schema.tables t
	JOIN information_schema.columns c
		ON t.table_schema = c.table_schema
        AND t.table_name = c.table_name
WHERE t.table_schema = 'colombes'
AND c.column_key = 'PRI'
AND t.table_name NOT IN (SELECT table_name
						FROM information_schema.columns
						WHERE table_schema = 'colombes'
						AND column_key = 'PRI'
						GROUP BY table_schema, table_name
						HAVING COUNT(*) > 1)
UNION
SELECT t.table_name, 
		t.table_type, 
        t.table_rows, 
        t.create_time,
        null,
        null
FROM information_schema.tables t
	JOIN information_schema.columns c
		ON t.table_schema = c.table_schema
        AND t.table_name = c.table_name
WHERE t.table_schema = 'colombes'
AND t.table_type = 'VIEW'
;