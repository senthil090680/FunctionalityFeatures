function showdiv(d)
{
  if(d=='sitesdiv')
  {
      document.getElementById('sexp').style.display='none';      
	  document.getElementById('sexpmin').style.display='none';      
	  document.getElementById('sexpmax').style.display='none';      
  }
  else if(d=='sexp')
  {
      document.getElementById('sitesdiv').style.display='none';      
	  document.getElementById('sexpmin').style.display='none'; 
	  document.getElementById('sexpmax').style.display='none'; 	
  } 
  else if(d=='sexpmin')
  {
      document.getElementById('sitesdiv').style.display='none';      
	  document.getElementById('sexp').style.display='none';
      document.getElementById('sexpmax').style.display='none';       
  }
  else if(d=='sexpmax')
  {
      document.getElementById('sitesdiv').style.display='none';      
	  document.getElementById('sexp').style.display='none';
      document.getElementById('sexpmin').style.display='none';       
  }
  if(document.getElementById(d).style.display=='block')
	{
      document.getElementById(d).style.display='none';
    }
	else
	{
      document.getElementById(d).style.display='block';
    }
}
function sitego()
{
	document.getElementById('myInput').value=document.frmhome.homesel[document.frmhome.homesel.selectedIndex].text;
    document.getElementById('sitesdiv').style.display='none';
}
function sitegoexp()
{
	document.getElementById('myInputexp').value=document.frmhomeexp.homeselexp[document.frmhomeexp.homeselexp.selectedIndex].text;
    document.getElementById('sexp').style.display='none';
}
function sitegoexpmin()
{
	document.getElementById('myInputexpmin').value=document.frmhomeexpmin.homeselexpmin[document.frmhomeexpmin.homeselexpmin.selectedIndex].text;
    document.getElementById('sexpmin').style.display='none';
}
function sitegoexpmax()
{
	document.getElementById('myInputexpmax').value=document.frmhomeexpmax.homeselexpmax[document.frmhomeexpmax.homeselexpmax.selectedIndex].text;
    document.getElementById('sexpmax').style.display='none';
}
