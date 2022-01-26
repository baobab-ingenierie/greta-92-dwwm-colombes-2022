USE colombes
;

-- Liste des adresses dans register.php
SELECT address_id, address, postal_code, city, country
FROM address
  INNER JOIN city 
    ON city.city_id = address.city_id
  INNER JOIN country
    ON country.country_id = city.country_id
;

SELECT address_id, CONCAT(address, ' ', postal_code, ' ', city, ' ', country) AS address
FROM address
  INNER JOIN city 
    ON city.city_id = address.city_id
  INNER JOIN country
    ON country.country_id = city.country_id
;