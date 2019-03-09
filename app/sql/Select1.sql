select a, b, c, sum(if(:uid, i2, count(:u, alert(:test), :z)) + 123)
from users U
where a <1 || b < 10 || z != 1 && b > 2 and c != 0 or d >= 2 and a > 100 and c < 300 or f = 10 || e = 100
and z = ? and c3 = :name or u > ? and :uid > :result;