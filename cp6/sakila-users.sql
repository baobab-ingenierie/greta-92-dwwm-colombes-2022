-- Cryptage : MD5, SHAx
SELECT 'Ines'
;

SELECT MD5('Ines')
; -- 041cf4f711b785e1b273e57908b26a8a

SELECT MD5('1ne$')
; -- 89b291d843f7be49093c68395d04766d - 32 car.

SELECT SHA1('Ines')
; -- f80b946cf1562ac47e84dee8c877e0d25b63960e - 40 car.

SELECT SHA2('Ines_est_de_retour_youpi_ya', 256)
; -- 481423fbce3e7ad23f4c277c9919033c00227c4ad2e29ee717f98fd4c9d13a53 - 64 car.

SELECT SHA2(CONCAT(MD5('password'), SHA1('my.address@nowhere.com')), 256)
; -- 5f65294619b885f3dad896135cea1e40c3bc40acd13ed04af761c05213c59f96

-- Définition de la BDD en cours
USE colombes
;

-- Création de la table USER
CREATE TABLE user(
	-- Colonnes
	user_id SMALLINT UNSIGNED,
    password VARCHAR(70),
    role TINYINT,
    token VARCHAR(40),
    avatar MEDIUMBLOB,
    -- Contraintes
    CONSTRAINT user_pk PRIMARY KEY (user_id),
    CONSTRAINT user_password_ck CHECK (LENGTH(TRIM(password))>0),
    CONSTRAINT user_role_ck CHECK (role BETWEEN 1 AND 5),
    CONSTRAINT user_id_fk FOREIGN KEY (user_id) 
		REFERENCES customer(customer_id)
);

-- Insertion des customers dans la table USER
DELETE 
FROM user
WHERE user_id>0
;

INSERT INTO user(user_id, password, role)
SELECT customer_id,
		SHA2(CONCAT(MD5('secret'), SHA1(LOWER(email))), 256),
        1
FROM customer
;

-- Requête qui teste le couple login/password
SELECT c.active,
		c.first_name,
        c.customer_id,
        c.email,
        u.password,
        u.role,
        u.avatar
FROM customer c 
JOIN user u
ON u.user_id = c.customer_id
WHERE c.email = ''
AND u.password = ''
;