select u.amadeus_lss_user                             lss_user,
       r.resellerCode                                 code,
       u.username                                     name,
       h.hqAmadeusId                                  office_id,
       'CSP'                                          csp,
       'AVH'                                          avh,
       CONCAT(r.resellerCode, ':', u.username)        source_id,
       CONCAT(u.amadeus_lss_user, ':', h.hqAmadeusId) target_id
from reseller_user u
       join reseller r on u.idParent = r.id
       join reseller_headquarters h on (r.id = h.idReseller and h.is_main_office = 1)
where u.amadeus_lss_user is not null and h.hqAmadeusId <> '';