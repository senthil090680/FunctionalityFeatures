function $(obj) {
   if(document.getElementById) {
        if(document.getElementById(obj)!=null) {
            return document.getElementById(obj)
        } else {
           return "";
       }
    } else if(document.all) {
        if(document.all[obj]!=null) {
            return document.all[obj]
        } else  {
          return "";
       }
    }
} 
var TabNxtVar=0;

function sitetab(dname, hpscount) {

	for(var i=1; i<=hpscount; i++)
		{
			var divid = "Ldiv"+i;
			var tdivid = "L"+i;

			document.getElementById(divid).className="disnon";
            document.getElementById(tdivid).className="clr1 txtdecornone";
		}

		for(var i=1; i<=hpscount; i++)
		{
			var divid1 = "Ldiv"+i;
			var tdivid = "L"+i;

			if(divid1==dname && TabNxtVar==0)
			{
				document.getElementById(dname).className = "disblk";
                document.getElementById(tdivid).className = "clr1 txtdecornone";
			}
		}
	}

function changetab(tab,mode)
{
	if(tab=='mrec')
	{
		document.getElementById("mrec").className = 'fleft largetxt searchheadact';
		document.getElementById("msnt").className = 'fleft largetxt govtheadnoact';
		document.getElementById("mbid").className = 'fleft largetxt govtheadnoact';
		document.getElementById("refe").className = 'fleft largetxt govtheadnoact';
		
	}
	if(tab=='msnt')
	{
		document.getElementById("msnt").className = 'fleft largetxt searchheadact';
		document.getElementById("mrec").className = 'fleft largetxt govtheadnoact';
		document.getElementById("mbid").className = 'fleft largetxt govtheadnoact';
		document.getElementById("refe").className = 'fleft largetxt govtheadnoact';
	}
	if(tab=='mbid')
	{
		document.getElementById("mbid").className = 'fleft largetxt searchheadact';
		document.getElementById("msnt").className = 'fleft largetxt govtheadnoact';
		document.getElementById("mrec").className = 'fleft largetxt govtheadnoact';
		document.getElementById("refe").className = 'fleft largetxt govtheadnoact';
	}
	if(tab=='refe')
	{
		document.getElementById("refe").className = 'fleft largetxt searchheadact';
		document.getElementById("mbid").className = 'fleft largetxt govtheadnoact';
		document.getElementById("msnt").className = 'fleft largetxt govtheadnoact';
		document.getElementById("mrec").className = 'fleft largetxt govtheadnoact';
	}
	
}