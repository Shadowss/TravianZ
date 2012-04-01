var timer=new Object();var ab=new Object();var bb=new Object();var cb=db();var eb=0;var auto_reload=1;var fb=new Object();var	is_opera=window.opera!==undefined;var	is_ie=document.all!==undefined&&window.opera===undefined;var is_ie6p=document.compatMode!==undefined&&document.all!==undefined&&window.opera===undefined;var is_ie7=document.documentElement!==undefined&&document.documentElement.style.maxHeight!==undefined;var is_ie6=is_ie6p&&!is_ie7;var is_ff2p=window.Iterator!==undefined;var is_ff3p=document.getElementsByClassName!==undefined;var is_ff2=is_ff2p&&!is_ff3p
function gb(){return hb('height');}
function ib(){return hb('width');}
function hb(jb){var kb=0,lb=0;if(typeof(window.innerWidth)=='number'){kb=window.innerWidth;lb=window.innerHeight;}
else if(document.documentElement&&(document.documentElement.clientWidth||document.documentElement.clientHeight)){kb=document.documentElement.clientWidth;lb=document.documentElement.clientHeight;}
else if(document.body&&(document.body.clientWidth||document.body.clientHeight)){kb=document.body.clientWidth;lb=document.body.clientHeight;}
if(jb=='height')return lb;if(jb=='width')return kb;}
var gmwds=false;function start(){mb("l1");mb("l2");mb("l3");mb("l4");initCounter();if(typeof init_local=='function'){init_local();}
if(quest.number===null){qst_handle();}
if(gmwds){gmwd();}
}
function nb(){return new Date().getTime();}
function db(){return Math.round(nb()/1000);}
function ob(pb){p=pb.innerHTML.split(":");qb=p[0]*3600+p[1]*60+p[2]*1;return qb;}
function rb(s,sb){var tb,ub,vb;if(s>-2){tb=Math.floor(s/3600);ub=Math.floor(s/60)%60;vb=s%60;t=tb+":";if(ub<10){t+="0";}
t+=ub+":";if(vb<10){t+="0";}
t+=vb;}
else
//{t=sb?'0:00:0?':"<a href=\"#\" onClick=\"return Popup(2,5);\"><span class=\"c0 t\">0:00:0</span>?</a>";}
document.location.reload();
return t;}
function initCounter(){for(var i=1;;i++){pb=document.getElementById("tp"+i);if(pb!=null){ab[i]=new Object();ab[i].node=pb;ab[i].counter_time=ob(pb);}
else{break;}
}
for(i=1;;i++){pb=document.getElementById("timer"+i);if(pb!=null){bb[i]=new Object();bb[i].node=pb;bb[i].counter_time=ob(pb);}
else{break;}
}
executeCounter();}
function executeCounter(){for(var i in ab){wb=db()-cb;xb=rb(ab[i].counter_time+wb);ab[i].node.innerHTML=xb;}
for(i in bb){wb=db()-cb;yb=bb[i].counter_time-wb;
if(eb==0&&yb<1){eb=1;if(auto_reload==1){setTimeout("document.location.reload()",1000);}
else if(auto_reload==0){setTimeout("mreload()",1000);}
}
else{}
xb=rb(yb);bb[i].node.innerHTML=xb;}
if(eb==0){window.setTimeout("executeCounter()",1000);}
}
function mb(zb){pb=document.getElementById(zb);if(pb!=null){fb[zb]=new Object();var $b=pb.innerHTML.match(/(\d+)\/(\d+)/);element=$b[0].split("/");_b=parseInt(element[0]);ac=parseInt(element[1]);bc=pb.title;if(bc!=0){cc=nb();timer[zb]=new Object();timer[zb].start=cc;timer[zb].production=bc;timer[zb].start_res=_b;timer[zb].max_res=ac;timer[zb].ms=3600000/bc;dc=100;if(timer[zb].ms<dc){timer[zb].ms=dc;}
timer[zb].node=pb;executeTimer(zb);}
else
{timer[zb]=new Object();fb[zb].value=_b;}
}
}
function executeTimer(zb){wb=nb()-timer[zb].start;if(wb>=0){ec=Math.round(timer[zb].start_res+wb*(timer[zb].production/3600000));if(ec>=timer[zb].max_res){ec=timer[zb].max_res;}
else
{window.setTimeout("executeTimer('"+zb+"')",timer[zb].ms);}
fb[zb].value=ec;timer[zb].node.innerHTML=ec+'/'+timer[zb].max_res;}
}
var fc=new Array(0,0,0,0,0);function add_res(gc){hc=fb['l'+(5-gc)].value;ic=haendler*carry;fc[gc]=jc(fc[gc],hc,ic,carry);document.getElementById('r'+gc).value=fc[gc];}
function upd_res(gc,kc){hc=fb['l'+(5-gc)].value;ic=haendler*carry;if(kc){lc=hc;}
else
{lc=parseInt(document.getElementById('r'+gc).value);}
if(isNaN(lc)){lc=0;}
fc[gc]=jc(parseInt(lc),hc,ic,0);document.getElementById('r'+gc).value=fc[gc];}
function jc(mc,nc,oc,pc){qc=mc+pc;if(qc>nc){qc=nc;}
if(qc>oc){qc=oc;}
if(qc==0){qc='';}
return qc;}
function rc(n,d){var p,i,x;if(!d)d=document;if((p=n.indexOf("?"))>0&&parent.frames.length){d=parent.frames[n.substring(p+1)].document;n=n.substring(0,p);}
if(!(x=d[n])&&d.all)x=d.all[n];for(var i=0;!x&&i<d.forms.length;i++)x=d.forms[i][n];for(var i=0;!x&&d.layers&&i<d.layers.length;i++)x=rc(n,d.layers[i].document);return x;}
function btm0(){var i,x,a=document.MM_sr;for(var i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++)x.src=x.oSrc;}
function btm1(){var i,j=0,x,a=btm1.arguments;document.MM_sr=new Array;for(var i=0;i<(a.length-2);i+=3)if((x=rc(a[i]))!=null){document.MM_sr[j++]=x;if(!x.oSrc)x.oSrc=x.src;x.src=a[i+2];}
}
function Popup(i,j,sc){if(typeof sc=='undefined'){sc='s';}
pb=document.getElementById("ce");if(pb!=null){var tc='<div class="popup3">'+'<a href="#" onClick="Close(); return false;"><img src="img/x.gif" border="1" class="popup4" alt="Move"></a>'+'<iframe frameborder="0" id="Frame" src="manual.php?'+sc+'='+i+'&typ='+j+'" width="412" height="440" border="0"></iframe>'+'</div>';pb.innerHTML=tc;uc();}
vc();if(!is_ie6&&!wc)return false;else return true;}
function uc(){if($('drag')){return;}
$$('.popup3')[0].grab(new Element('div',{'id':'drag'}
),'top').makeDraggable({'handle':'drag'}
);if($$('body')[0].getStyle('direction').toLowerCase()=='rtl'){$$('.popup3')[0].setStyle('direction','rtl').getParent().setStyle('direction','ltr');}
}
function vc(){if(gb()<700||ib()<700){document.getElementById("ce").style.position='absolute';wc=true;}
else{document.getElementById("ce").style.position='fixed';wc=false;}
}
function Close(){pb=document.getElementById("ce");if(pb!=null){pb.innerHTML='';}
if(quest.anmstep!==false){quest.anmstep=false;}
}
function Allmsg(){for(var x=0;x<document.msg.elements.length;x++){var y=document.msg.elements[x];if(y.name!='s10')y.checked=document.msg.s10.checked;}
}
function xy(){xc=screen.width+":"+screen.height;document.snd.w.value=xc;}
function my_village(){var yc=Math.round(0);var zc;var e=document.snd.dname.value;for(var i=0;i<dorfnamen.length;i++){if(dorfnamen[i].indexOf(e)>-1){yc++;zc=dorfnamen[i];}
}
if(yc==1){document.snd.dname.value=zc;}
}
var $c=document.getElementById?1:0;var _c=document.all?1:0;var ad=(navigator.userAgent.indexOf("Mac")>-1)?1:0;var bd=(_c&&(!ad)&&(typeof(window.offscreenBuffering)!='undefined'))?1:0;var cd=bd;var dd=bd&&(window.navigator.userAgent.indexOf("SV1")!=-1);function changeOpacity(ed,opacity){if(bd){ed.style.filter='progid:DXImageTransform.Microsoft.Alpha(opacity='+(opacity*100)+')';}
else if($c){ed.style.MozOpacity=opacity;}
}
function fd(url,gd,hd,id){if(hd===undefined){hd='GET';}
var jd;if(window.XMLHttpRequest){jd=new XMLHttpRequest();}
else if(window.ActiveXObject){try{jd=new ActiveXObject("Msxml2.XMLHTTP");}
catch(e){try{jd=new ActiveXObject("Microsoft.XMLHTTP");}
catch(e){}
}
}
else{throw'Can not create XMLHTTP-instance';}
jd.onreadystatechange=function(){if(jd.readyState==4){if(jd.status==200){var kd=jd.getResponseHeader('Content-Type');kd=kd.substr(0,kd.indexOf(';'));switch(kd){case'application/json':gd((jd.responseText==''?null:eval('('+jd.responseText+')')));break;case'text/plain':case'text/html':gd(jd.responseText);break;default:throw'Illegal content type';}
}
else{throw'An error has occurred during request';}
}
}
;jd.open(hd,url,true);if(hd=='POST'){jd.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=utf-8');var ld=md(id);}
else{var ld=null;}
jd.send(ld);}
function md(nd){var od='';var pd=true;for(var qd in nd){od+=(pd?'':'&')+qd+'='+window.encodeURI(nd[qd]);if(pd){pd=false;}
}
return od;}
function mreload(){param='reload=auto';url=window.location.href;if(url.indexOf(param)==-1){if(url.indexOf('?')==-1){url+='?'+param;}
else
{url+='&'+param;}
}
document.location.href=url;}
var rd={'index':0,'dir':0,'size':null,'fields':[],'cindex':0,'usealternate':false}
;var m_c=rd;var sd;var td;var ud;var vd;var wd;var xd;var yd;var zd;var $d;var _d=false;var ae;var be;var ce;var de=[];de[38]=1;de[39]=2;de[40]=3;de[37]=4;var ee={}
;var fe;var ge;function map_init(){sd=false;td=false;ud=false;vd=false;xd=0;wd=0;fe=he('karte2');ie(['i','a','t']);if(null==m_c.az){throw'm_c.az muss seitenspezifisch initialisiert werden.';}
for(var p in m_c.az){document.getElementById('ma_'+p).onclick=je;}
var ke=['mcx','mcy','x','y','map_infobox'];for(var i=0;i<ke.length;i++){ee[ke[i]]=document.getElementById(ke[i]);}
ke=['mcx','mcy'];for(var i=0;i<ke.length;i++){ee[ke[i]].onfocus=function(){vd=true;}
;ee[ke[i]].onblur=function(){vd=false;}
;}
ee.ibox_cells=[];ee.ibox_cells[0]=ee.map_infobox.firstChild.firstChild.lastChild;for(var i=1;i<=3;i++){ee.ibox_cells[i]=ee.map_infobox.firstChild.nextSibling.childNodes[i-1].lastChild}
document.onkeyup=le;document.onkeydown=me;document.onkeypress=ne;document.map_coords.onsubmit=oe;ee.mx=[];ee.my=[];for(var i=0;i<mdim.x;i++){for(var j=0;j<mdim.y;j++){area=pe(i,j,'a');area.onmouseover=qe;area.onmouseout=re;if(fe){area.onclick=se;}
te(m_c.ad[i][j],area);}
ee.mx[i]=document.getElementById('mx'+i);ee.my[i]=document.getElementById('my'+i);}
var ue=document.getElementById('map_makelarge');if(ue){ue.onclick=ve;}
if(mdim.x==13){document.getElementById('map_popclose').onclick=we;}
}
function se(){opener.location=this.href;return false;}
function xe(ye){var ze=document.getElementById('map_makelarge');ze.className=ye?'loading':'';}
function $e(_e){var af;var bf;if(ee.map_infobox!=null){if(_e.normal_field){var cf=df(_e.nr*1);af=[text_k.verlassenes_tal+': '+cf.join('-')];bf='empty';}
else if(_e.free_oasis&&!_e.classic_oasis){af=[text_k.freie_oase];bf='oasis_empty';}
else if(_e.occupied_oasis&&!_e.classic_oasis){af=[text_k.besetztes_tal,_e.name,_e.ew,_e.ally];bf='oasis';}
else if(_e.village){var text='<span class="tribe tribe'+_e.vid+'">'+_e.dname+'</span>';af=[text,_e.name,_e.ew,_e.ally];bf='village';}
else{af=[text_k.details];bf='default';}
}
for(var i=0;i<4;i++){ee.ibox_cells[i].innerHTML=(af[i]===undefined||af[i]==='')?'-':af[i].replace(/\&/g,"&amp;");}
ee.map_infobox.className=bf;}
function ef(ff,gf){return((ff-1)*10)+gf
}
function hf(jf){ee.x.firstChild.nodeValue=jf.x;ee.y.firstChild.nodeValue=jf.y;}
function kf(jf){ee.mcx.value=jf.x;ee.mcy.value=jf.y;l=$$('div.cropfinder_icon a').set('href','cropfinder.php?x='+jf.x+'&y='+jf.y);}
function lf(x,y){return(400+x)+(400-y)*801+1;}
function ve(){if(mmode){zd=window.open(this.href,"map","top=100,left=25,width=1007,height=585");zd.focus();}
else{xe(true);fd('ajax.php?f=kp&z='+lf(m_c.z.x,m_c.z.y),function(mf){xe(false);ae=document.getElementsByTagName('body')[0];be=document.getElementsByTagName('html')[0];ae.parentNode.removeChild(ae);ce=document.createElement('body');ce.innerHTML=mf.lm;ce.style.backgroundColor='#ffffff';be.appendChild(ce);m_c=[];for(var qd in mf.dat.m_c){m_c[qd]=mf.dat.m_c[qd];}
m_c.fields=[];mdim=mf.dat.mdim;mmode=mf.dat.mmode;map_init();}
);}
return false;}
function we(){if(fe){window.close();}
else{mdim={'x':7,'y':7,'rad':3}
;var nf=[];for(var i=0;i<mdim.x;i++){nf[i]=[];for(var j=0;j<mdim.y;j++){nf[i][j]=pe(i+3,j+3,'a').details;}
}
be.removeChild(ce);be.appendChild(ae);map_init();var of;var area;for(var i=0;i<mdim.x;i++){for(var j=0;j<mdim.y;j++){area=pe(i,j,'a');of=pe(i,j,'i');area.details=nf[i][j];area.details.fresh={}
;of.className=nf[i][j].img;pf(area,of);}
}
hf(m_c.z);kf(m_c.z);}
return false;}
function je(){var qf=1*this.id.substring(4,5);var rf=1*(this.id.substring(5,7)=='p7'?mdim.x:1);map_scroll(qf,rf);return false;}
function sf(z){var x=z.x-mdim.rad;var y=z.y-mdim.rad;var tf=z.x+mdim.rad;var uf=z.y+mdim.rad;return{'x':x,'y':y,'xx':tf,'yy':uf}
;}
function vf(qf,rf,wf){if(wf==null){wf=0;}
if(m_c.size==null){throw'Globale Variable m_c.size muss auf den Wert von $travian[map_prefetch_rows]) gesetzt werden.';}
var xf,yf;if(null===rf||1===rf){yf=m_c.size-1;}
else if(mdim.x==rf){xf=mdim.x;yf=-(mdim.x-1);}
else{throw'Parameter steps muss 1 oder Breite der Karte in Feldern sein.';}
var x,y,tf,uf,z;var z=m_c.z;switch(qf){case 1:x=z.x+mdim.rad;y=z.y+mdim.rad+wf;tf=z.x-mdim.rad;uf=y+yf;break;case 2:x=z.x+mdim.rad+wf;y=z.y-mdim.rad;tf=x+yf;uf=z.y+mdim.rad;break;case 3:x=z.x+mdim.rad;y=z.y-mdim.rad-wf;tf=z.x-mdim.rad;uf=y-yf;break;case 4:x=z.x-mdim.rad-wf;y=z.y-mdim.rad;tf=x-yf;uf=z.y+mdim.rad;break;}
return{'x':x,'y':y,'xx':tf,'yy':uf}
;}
function zf($f){if($f>400){$f-=801;}
if($f<-400){$f+=801;}
return $f;}
function _f($f){if($f>400){$f=400;}
if($f<-400){$f=-400;}
return $f;}
function ag(qf,rf){var z={}
;z.x=m_c.z.x*1;z.y=m_c.z.y*1;switch(qf){case 1:z.y+=rf;break;case 2:z.x+=rf;break;case 3:z.y-=rf;break;case 4:z.x-=rf;break;}
m_c.z.x=zf(z.x);m_c.z.y=zf(z.y);}
function bg(cg){return'ajax.php?f=k7&x='+cg.x+'&y='+cg.y+'&xx='+cg.xx+'&yy='+cg.yy;}
function map_scroll(qf,rf,dg){var cg,eg;if(sd){return false;}
if(fg()){if(td){return false;}
sd=true;gg();m_c.usealternate=false;m_c.cindex=0;if(dg!==undefined){m_c.z.x=_f(dg.x);m_c.z.y=_f(dg.y);cg=sf(m_c.z);}
else{ag(qf,rf);cg=vf(qf,rf);}
hg=bg(cg);fd(hg,ig);}
else{if(jg()){if(td){return false;}
td=true;ag(qf,rf);cg=vf(qf,rf,2);hg=bg(cg);fd(hg,ig);}
else if(kg()){ag(qf,rf);lg();gg();}
else{ag(qf,rf);}
mg(qf,rf);}
function ig(ng){var og;if(jg()){og=pg(m_c.cindex);m_c.usealternate=false;td=false;}
else{og=m_c.cindex;}
m_c.fields[og]=ng;if(fg()){if(dg!==undefined){mg(0,0,m_c.z);qg('x');qg('y');}
else{mg(qf,rf);qg(qf);}
sd=false;}
}
function jg(){return m_c.usealternate;}
function fg(){return(qf!=m_c.dir||rf==mdim.x||(rf==1&&rf!=m_c.steps)||dg!==undefined);}
function kg(){return(m_c.index==m_c.size);}
}
function rg(qf,rf){m_c.dir=qf;m_c.steps=rf;}
function gg(){m_c.index=0;}
function sg(){m_c.index++;if(m_c.index==m_c.size-2){m_c.usealternate=true;}
}
function lg(){m_c.cindex=pg(m_c.cindex);}
function mg(qf,rf,dg){var tg=document.getElementById('map_content');var ug=tg.parentNode;if(1==rf){vg(qf);wg(m_c.fields[m_c.cindex],qf,rf);qg(qf);sg();}
else if(mdim.x==rf||dg!==undefined){xg(m_c.fields[m_c.cindex]);}
if(wd==0){kf(m_c.z);}
hf(m_c.z);rg(qf,rf);}
function pg(og){return(og==0?1:0);}
function xg(ng){for(var i=0;i<mdim.x;i++){for(var j=0;j<mdim.y;j++){yg(i,j,ng[i][j]);}
}
}
function zg($g,_g){_g.details.href=$g;}
function yg(ah,bh,_e){var of=pe(ah,bh,'i');var area=pe(ah,bh,'a');te(_e,area);of.className=area.details.img;pf(area,of);}
function pf(area,of){if(area.details.atyp){if(!of.firstChild){of.appendChild(document.createElement('span'));}
of.firstChild.className='m'+area.details.atyp;}
else{if(of.firstChild){of.removeChild(of.firstChild);}
}
}
function te(_e,area){area.details={}
;var ch=['x','y','nr','typ','querystring','img','dname','name','ew','ally','vid','atyp','atime'];for(var i=0;i<_e.length;i++){area.details[ch[i]]=_e[i];}
area.details.normal_field=area.details.name===undefined&&area.details.typ==0;area.details.free_oasis=area.details.name===undefined&&area.details.typ!=0;area.details.occupied_oasis=area.details.name!==undefined&&area.details.typ!=0;area.details.village=area.details.name!==undefined&&area.details.typ==0;area.details.fresh={}
;area.details.classic_oasis=area.details.querystring==='';}
function df(dh){switch(dh){case 1:return[3,3,3,9];case 2:return[3,4,5,6];case 3:return[4,4,4,6];case 4:return[4,5,3,6];case 5:return[5,3,4,6];case 6:return[1,1,1,15];case 7:return[4,4,3,7];case 8:return[3,4,4,7];case 9:return[4,3,4,7];case 10:return[3,5,4,6];case 11:return[4,3,5,6];case 12:return[5,4,3,6];default:return false;}
}
function oe(){var x=parseInt(this.xp.value);var y=parseInt(this.yp.value);if(!isNaN(x)&&!isNaN(y)){map_scroll(0,0,{'x':x,'y':y}
);}
return false;}
function ne(e){if(vd){return true;}
var qd=(window.event)?event.keyCode:e.keyCode;var qf=eh(qd);if(qf!=0){return false;}
}
function qe(){_d=true;hf(this.details);$e(this.details);fh(this);ge=this;}
function fh(area){if(!area.details.fresh.href){if(area.details.classic_oasis){area.removeAttribute('href');area.style.cursor='default';}
else{area.href='karte.php?'+area.details.querystring;area.style.cursor='pointer';}
area.details.fresh.href=true;}
if(!area.details.fresh.title){area.details.fresh.title=gh(area);}
}
function gh(area){if(area.details.normal_field){area.title='';}
else if(area.details.free_oasis&&!area.details.classic_oasis){area.title=text_k.freie_oase;}
else if(area.details.occupied_oasis&&!area.details.classic_oasis){area.title=text_k.besetztes_tal;}
else if(area.details.village){if(area.details.atime!==undefined){area.title=area.details.dname+' '+rb(area.details.atime-Math.floor(new Date().getTime()/1000),true);return false;}
else{area.title=area.details.dname;}
}
else{area.title='';}
return true;}
function re(){var area=this;window.setTimeout(function(){if(ge==area){_d=false;hf(m_c.z);hh();}
}
,50);}
function wg(ng,qf){var ih,jh;for(var i=0;i<mdim.x;i++){switch(qf){case 1:ih=i;jh=mdim.x-1;_e=ng[i][m_c.index];break;case 2:ih=mdim.x-1;jh=i;_e=ng[m_c.index][i];break;case 3:ih=i;jh=0;_e=ng[i][m_c.size-m_c.index-1];break;case 4:ih=0;jh=i;_e=ng[m_c.size-m_c.index-1][i];break;}
yg(ih,jh,_e);}
}
function kh(x,y,tf,uf){var of=pe(x,y,'i');var lh=pe(tf,uf,'i');mh(of,lh);if(of.firstChild){if(!lh.firstChild){lh.appendChild(document.createElement('span'))}
lh.firstChild.className=of.firstChild.className;}
else{if(lh.firstChild){lh.removeChild(lh.firstChild);}
}
nh(x,y,tf,uf);}
function nh(x,y,tf,uf){_e=pe(x,y,'a');oh=pe(tf,uf,'a');oh.details=_e.details;oh.details.fresh={}
;}
function mh(of,lh){lh.className=of.className;}
function vg(qf){for(var i=0;i<mdim.x;i++){for(var j=1;j<mdim.x;j++){switch(qf){case 1:kh(i,j,i,j-1);break;case 2:kh(j,i,j-1,i);break;case 3:kh(i,mdim.x-1-j,i,mdim.x-j);break;case 4:kh(mdim.x-1-j,i,mdim.x-j,i);break;}
}
}
}
function eh(qd){if(de[qd]!==undefined){return de[qd];}
return 0;}
function le(e){if(vd){return true;}
var qd=((window.event)?event.keyCode:e.keyCode);if(16==qd){ud=false;}
var qf=eh(qd);if(qf==wd&&wd!=0){wd=0;kf(m_c.z);ph();}
}
function m_r(qf,qh){if(wd==qf&&qh==xd){window.setTimeout(function(){m_r(qf,qh)}
,100);map_scroll(qf,1);}
}
function qg(rh){var jb;switch(rh){case 2:case 4:case'x':jb='x';break;case 1:case 3:case'y':jb='y';break;}
var sh='m'+jb;var th;var uh;var vh=0;var wh=0;for(var i=0;i<mdim.x;i++){if(jb=='x'){vh=i;}
else{wh=i;}
if(ee[sh][i]){th=pe(vh,wh,'a').details[jb];ee[sh][i].firstChild.nodeValue=th;}
}
}
function me(e){if(vd){return true;}
var qd=(window.event)?event.keyCode:e.keyCode;if(qd==16){ud=true;}
var qf=eh(qd);if(qf!=0&&qf!=wd){var rf=(ud?mdim.x:1);map_scroll(qf,rf);var qh=new Date().getTime();if(rf==1){window.setTimeout(function(){m_r(qf,qh)}
,500);}
xd=qh;wd=qf;ph();}
if(qf!=0){return false;}
}
function ph(){window.setTimeout(function(){if(_d){$e(ge.details);}
}
,60);}
var xh={}
;function pe(ah,bh,yh){if(xh){return xh[yh][ah][bh];}
}
function ie(zh){var yh;for(var i=0;i<zh.length;i++){yh=zh[i];xh[yh]=[];for(var ah=0;ah<mdim.x;ah++){xh[yh][ah]=[];for(var bh=0;bh<mdim.y;bh++){xh[yh][ah][bh]=document.getElementById(yh+'_'+ah+'_'+bh);}
}
}
}
function hh(){$e({$h:'',name:'',_h:'',ai:'',x:m_c.z.x,y:m_c.z.y}
);}
var quest={'anmstep':false}
;function bi(length,ci){if(length===undefined){length=8;}
if(ci===undefined){ci=0.5;}
var di='0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz';var bi='';for(var i=0;i<length;i++){var ei=Math.floor((Math.random()+ci)*0.5*di.length);bi+=di.substring(ei,ei+1);}
return bi;}

function fi(qact,qact2){
if(qact===undefined){
qact=false;
} 

if(qact2===undefined){
qact2=false;
} 

var gi='ajax.php?f=qst';var ci=(Math.abs(quest.number)+1)/(Math.abs(quest.last)+1);return gi+'&cr='+bi(4,ci)+'&qact='+qact+'&qact2='+qact2;}

function qst_next(jf,act,act2){

var id;

if(jf){id={'x':document.getElementById('qst_val_x').value,'y':document.getElementById('qst_val_y').value};}

else{id={'val':document.getElementById('qst_val').value};}

pi();

fd(fi(act,act2),function(mf){for(var qd in mf){quest[qd]=mf[qd];}},'POST',id);

qst_wfm();
}



function hi(){document.getElementById('ce').innerHTML='';var step;if(quest.anmstep===false){step={'step':{}
,'source':{}
,'current':{}
,'target':{'width':448,'height':482,'top':-1}
,'fps':50,'n':10,'i':0,'anm':{}
}
;step.target[quest.rtl?'right':'left']='-502';}
else{step=quest.anmstep;ii(false);}
step.anm=document.getElementById('anm');for(var ji in step.target){step.source[ji]=Number(step.anm.style[ji].substr(0,step.anm.style[ji].length-2));step.current[ji]=step.source[ji];step.step[ji]=Math.round((step.target[ji]-step.source[ji])/step.n);}
step.timeout=1000/step.fps;quest.cstep=step;quest.anmlock=true;window.setTimeout(anm_step,step.timeout);}
function ki(step){for(var ji in step.target){step.anm.style[ji]=step.current[ji]+'px';}
}
function li(step){step.i++;if(step.i==2){step.anm.style.visibility='visible';}
for(var ji in step.target){step.current[ji]+=step.step[ji];}
return step;}
function ii(mi){if(mi===undefined){mi==false;}
var ni=document.getElementById('ce');if(mi){var oi='<div class="popup3 quest"><a href="#" onClick="qst_handle()"><img src="img/x.gif" border="1" class="popup4" alt="Close"></a><div id="popup3"</div></div>';ni.innerHTML=oi;pi();qst_wfm();vc();qi(true);uc();}
else{ni.innerHTML='';qi(false);}
}
function qi(vis){if(!is_ie6){return;}
var ri=vis?'hidden':'visible';var si=document.getElementsByTagName('select');var n=si.length;for(var i=0;i<n;i++){si[i].style.visibility=ri;}
}
function anm_step(){step=li(quest.cstep);ki(step);if(step.i<step.n){window.setTimeout('anm_step()',step.timeout);}
else{step.anm.style.visibility='hidden';quest.anmlock=false;quest.cstep=false;if(quest.anmstep===false){step.current=step.target;step.target=step.source;step.source=step.current;ki(step);step.i=0;ii(true);quest.anmstep=step;}
else{quest.anmstep=false;if(quest.number>=quest.last||quest.altstep==9){document.getElementById('qge').innerHTML='';}
}
}
}
function ti(){var timer=document.getElementById('qst_timer');if(timer&&timer.parentNode.style.display!='none'){if(!timer.timestamp){timer.timestamp=db()+ob(timer);}
else{var ui=timer.timestamp-db();if(ui<0){timer.parentNode.style.display='none';document.getElementById('qst_reshere').style.display='block';}
else{timer.innerHTML=rb(ui);}
}
window.setTimeout(ti,1000);}
}
function qst_fhandle(){id={'val':1}
;fd(fi(),function(mf){}
,'POST',id
);qst_handle();}
function qst_handle(){if(quest.anmlock){return false;}
quest.markup=false;if(quest.anmstep===false){fd(fi(),function(mf){for(var qd in mf){quest[qd]=mf[qd];}
}
);}
hi();if(quest.ar){auto_reload=quest.ar;quest.ar=undefined;}
}
function qst_wfm(){var vi=document.getElementById('popup3');if(!quest.markup||!vi){if(!quest.anmlock){window.setTimeout('qst_wfm(true)',50);}
}
else{wi(quest);vi.innerHTML=quest.markup;uc();xi=false;if(quest.reward.finish&&window.bld){var yi=document.getElementById('building_contract');if(bld.length<2&&bld[0].gid==1){yi.innerHTML='';xi=0;}
else{for(var i in bld){if(bld[i].stufe==1&&bld[i].gid==1){yi.getElementsByTagName('table')[0].deleteRow(i);xi=i;break;}
}
}
if(xi!==false){var zi=$$('#t3 .rf'+bld[xi].aid)[0];if(zi){zi.removeClass('rf'+bld[xi].stufe);zi.addClass('rf'+bld[xi].stufe+1);}
else{$$('.f3')[0].appendChild(new Element('img',{'class':('reslevel rf'+bld[xi].aid+' level'+bld[xi].stufe),'src':'img/x.gif'}
));}
}
quest.ar=auto_reload;auto_reload=-1;}
if(quest.reward.plus){var of=document.getElementById('logo').className='plus';}
quest.markup=false;quest.msg=false;}
}
function qst_weiter(){pi();fd(fi(),function(mf){document.getElementById('popup3').innerHTML=mf.markup;var $i=document.getElementById('qgei');$i.className=mf.qgsrc;wi(mf);uc();}
);}
function pi(){document.getElementById('popup3').innerHTML='<img src="img/x.gif" class="xlo" />';}
function qst_enter(jf){if(jf===undefined){jf=false;}
var id;if(jf){id={'x':document.getElementById('qst_val_x').value,'y':document.getElementById('qst_val_y').value}
;}
else{id={'val':document.getElementById('qst_val').value}
;}
pi();fd(fi(),function(mf){for(var qd in mf){quest[qd]=mf[qd];}
}
,'POST',id
);qst_wfm();}
function qst_enter_coords(){qst_enter(true);}
function wi(_i){var $i=document.getElementById('qgei');if($i&&_i.qgsrc){$i.className=_i.qgsrc;}
var aj=document.getElementById('n5');if(aj&&_i.msrc){aj.className=_i.msrc;}
if(_i.cookie){var date=new Date();date.setTime(date.getTime()+300000);document.cookie='t3fw=1; expires='+date.toUTCString()+';';}
if(_i.fest&&he('dorf2')){document.getElementById('content').innerHTML+=_i.fest;}
window.setTimeout(ti,30);}
function he(bj){return window.location.href.indexOf(bj+'.php')!=-1;}
function vil_levels_toggle(){var cj=$('levels'),dj=$('lswitch');cj.toggleClass('on');dj.toggleClass('on');if(cj.hasClass('on')){document.cookie='t3l=1; expires=Wed, 1 Jan 2020 00:00:00 GMT';}
else{document.cookie='t3l=1; expires=Thu, 01-Jan-1970 00:00:01 GMT';}
}
function gmwd(){if(is_ff2&&document.getElementById("gmwi").offsetWidth<50){document.cookie="a3=2; expires=Wed, 1 Jan 2020 00:00:00 GMT";}
else{document.cookie="a3=1; expires=Wed, 1 Jan 2020 00:00:00 GMT";}
}
function gmc(){document.getElementById("gmw").style.display="none";document.cookie="a3=3; expires=Wed, 1 Jan 2020 00:00:00 GMT";}