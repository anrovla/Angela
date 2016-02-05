*** PRV DEL ***
- da ima prviot web servis sortirano po play count.

1. Vcera ti ja update-irav tabelata songs da ima validen playcount po song url. 
2. Gi proveriv podatocite i vo red se.
3. Samo modificiraj go selectot vo prviot web servis da ima na kraj ordered by playcount
4. Podobri go vtoriot web servis vo select sql i dodadi / modificiraj 'and name is not null order by similarity desc'
4. Ke si raboti stariot index.html




*** VTOR DEL ***
- da ima multiple select (up to 5 songs) i da gi dava top 15 similarity ordered by similarity desc od SITE izbraani pesni.


1. Ke ti pratam zip so files na FB
2. Kompletno nov index_ms.html
3. Nov, tret web servis, zemi go vtoriot i napravi tret koj:
 - ke prima isto parametri kako vtoriot, no ke vrakja song_ID_orig, name, artist, similarity
 - SQL selectot: select song_ID_orig, name, artist, similarity from sim_mview where song_ID_orig = $url and name is not null order by similarity desc
 - Napravi novo view: sim_mview so sledniot select:
   - ********** view **************
	CREATE  
	VIEW `sim_mview` AS 
 	select `t2`.`name` AS `name`,
        	`t2`.`artist` AS `artist`,
        	`t1`.`song_ID_orig` AS `song_ID_orig`,
		`t1`.`similarity` AS `similarity` 
   	from (`similarity` `t1` left join `songs` `t2` on((`t2`.`url` = `t1`.`song_ID_compare`)));

