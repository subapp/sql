select t0.id from test t0
where

a = 1 and b = 3 or c = 10 and d != 20
xor 1 !=2

GROUP by u.gid, StrToUpper(u.name)
order by t0.id desc , rand() asc, count (Distinct u.id) Desc


limit 100, 10