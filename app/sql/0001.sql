select id
FROM tables t0
WHERE t0.id > 100 AND t0.sub_id <= 1000
OR t0.dt IS NULL || t0.name LIKE "%admin%"