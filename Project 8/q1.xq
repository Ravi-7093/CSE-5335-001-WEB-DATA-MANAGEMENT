<output>
	<first_one>
		{ 
			for $i in doc("reed.xml")//course
			where   $i/subj="MATH" and ($i//building="LIB" and $i//room="204")
			return <course> 
						{ $i/title }
						{ $i/instructor }
						{ $i//start_time }
						{ $i//end_time }
					</course>
		}
	</first_one>
</output>