<output>
		{   let $b := distinct-values(doc("reed.xml")//course/subj)
            for $e in $b
			return <department>
						<subject> { $e} </subject>
						<count>{count(distinct-values(doc("reed.xml")//course[subj = $e]//title))}</count>
					</department>
		}
</output>