select ids, `users`.id, `tables`.user_name
FROM tables t0, `users` u, product, (SELECT id FROM test) T
WHERE t0.id > 100 AND t0.sub_id <= ? and t0.id > ?
OR t0.dt IS NULL || t0.name LIKE "%admin%"
And t0.email = :email
