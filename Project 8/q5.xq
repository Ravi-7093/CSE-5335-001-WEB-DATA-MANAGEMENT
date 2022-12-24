<output>
		{   let $b := doc("reed.xml")//course
            for $t in distinct-values($b/instructor)
            let $c := distinct-values($b[instructor=$t]//title)
			return <instructor>
						<full_name> { $t } </full_name>
						<titles>
                            { for $s in $c
                              return <title>{$s}</title>
                            }
                        </titles>
					</instructor>
		}
</output>