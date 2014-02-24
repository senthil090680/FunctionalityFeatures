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
	if(tab=='mrec' && mode=='rcact')
	{
		$('mrec').className='fleft largetxt searchheadact';
		$('msnt').className='fleft largetxt govtheadnoact';
	}
	else if(tab=='msnt' && mode=='stinact')
	{
		$('mrec').className='fleft largetxt searchheadnoact';
		$('msnt').className='fleft largetxt govtheadact';
	}
	
}