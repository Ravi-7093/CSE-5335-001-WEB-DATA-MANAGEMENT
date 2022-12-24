<output>
		{   let $b := distinct-values(doc("reed.xml")//course/instructor)
            for $e in $b
			return <instructor>
						<full_name> { $e} </full_name>
						<count>{count(distinct-values(doc("reed.xml")//course[instructor = $e]))}</count>
					</instructor>
		}
</output>