select t0.id from test t0
where
(a = 1 and b = 3 or c = 10 and d != 20)
xor
a <1 || b < 10 || z != 1 && b > 2 and c != 0 or d >=2 and a > 100 and c < 300 or f = 10 || e = 100;