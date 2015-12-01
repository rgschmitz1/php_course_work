USE mismatchdb;

SELECT mr.response_id, mr.topic_id, mr.response,
  mt.name AS topic_name, mc.name AS category_name
  FROM mismatch_response AS mr
  INNER JOIN mismatch_topic AS mt USING (topic_id)
  INNER JOIN mismatch_category AS mc USING (category_id)
  WHERE mr.user_id = 3;
