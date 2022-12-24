<output>
		{   let $b := doc("reed.xml")//course
            for $t in distinct-values($b/title)
            let $c := distinct-values($b[title=$t]/instructor)
			return <course>
						<title> { $t } </title>
						<all_instructors>
                            { for $s in $c
                              return <instructor>{$s}</instructor>
                            }
                        </all_instructors>
					</course>
		}
</output>