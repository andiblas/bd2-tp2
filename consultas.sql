--ESTA CONSULTA ES DE LA FOTO QUE PASO GUSTAVO SIN EL INTERSECT
SELECT u1.id as id1, u2.id as id2
	FROM persona as u1, persona as u2
	WHERE u1.id != u2.id 
	AND u1.id < u2.id
	AND NOT EXISTS (
		SELECT p3.peliculaid FROM pelis_que_vio as p3 where p3.usuarioid = u1.id OR p3.usuarioid = u2.id
			EXCEPT (
			SELECT p1.peliculaid FROM pelis_que_vio as p1, 
			pelis_que_vio as p2 
			where p1.usuarioid = u1.id AND p2.usuarioid = u2.id 
			AND p1.peliculaid = p2.peliculaid
			)
	);
  
  --ESTA CONSULTA ESTA UN POCO (BASTANTE) MAS MODIFICADA QUE LA ANTERIOR RESPECTO A LA DE LA FOTO
  SELECT u1.id as id1, u2.id as id2
	FROM persona as u1, persona as u2
	WHERE u1.id != u2.id 
	AND u1.id < u2.id
	AND ((SELECT COUNT(p.peliculaid) FROM pelis_que_vio as p WHERE p.usuarioid = u1.id) = 
		(SELECT COUNT(p.peliculaid) FROM pelis_que_vio as p WHERE p.usuarioid = u2.id))
	AND NOT EXISTS (	
			(SELECT p1.peliculaid FROM pelis_que_vio as p1, 
			pelis_que_vio as p2 
			where p1.usuarioid = u1.id AND p2.usuarioid = u2.id 
			AND p1.peliculaid != p2.peliculaid
			)

	)
	ORDER BY id1, id2;
