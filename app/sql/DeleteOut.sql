DELETE G . *
FROM users AS U
       INNER JOIN groups AS G ON (G.id = U.gid)
WHERE u.id > 1