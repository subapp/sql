delete G.* from
users U
Inner join groups G On (G.id = U.gid)
where u.id > 1