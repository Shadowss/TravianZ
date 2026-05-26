<style>
:root{
  --bg:#0f172a; --bg2:#1e293b; --card:#ffffff; --muted:#64748b;
  --text:#0f172a; --border:#e5e7eb; --primary:#16a34a; --radius:14px;
}
*{box-sizing:border-box}
body{margin:0;background:#f1f5f9!important;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;color:var(--text);}

/* ASCUNDE VECHIUL */
#header, #mtop, #dynamic_header, img#msfilter, .footer-stopper, #side_info,
#footer, .footer, #ce, div[style*="TRAVIANGAMES"], .copyright {display:none !important;}

.wrapper{max-width:1100px;margin:0 auto!important;padding:0 16px 20px!important;background:transparent!important;box-shadow:none!important;}

/* HEADER */
.tz-header{
  max-width:1100px;margin:20px auto 0;padding:22px 24px;
  background:linear-gradient(135deg,var(--bg),var(--bg2));
  border-radius:18px;color:#fff;display:flex;align-items:center;gap:16px;
  box-shadow:0 12px 30px rgba(2,6,23,.25);
}
.tz-header svg{width:42px;height:42px;flex-shrink:0;}
.tz-header h1{margin:0;font-size:24px;letter-spacing:.3px;}
.tz-header p{margin:2px 0 0;color:#cbd5e1;font-size:13px;}

/* FOOTER NOU */
.tz-footer{
  max-width:1100px;margin:30px auto 30px;padding:16px 20px;
  background:#fff;border:1px solid var(--border);border-radius:14px;
  display:flex;justify-content:space-between;align-items:center;gap:12px;
  color:#64748b;font-size:13px;box-shadow:0 4px 14px rgba(0,0,0,.04);
}
.tz-footer b{color:#0f172a;}
@media(max-width:700px){.tz-footer{flex-direction:column;text-align:center;}}

#mid{display:grid!important;grid-template-columns:260px 1fr!important;gap:18px!important;margin:18px 0 0!important;background:transparent!important;}
#side_navi{background:var(--card)!important;border:1px solid var(--border)!important;border-radius:var(--radius)!important;padding:14px!important;height:fit-content!important;box-shadow:0 4px 14px rgba(0,0,0,.04)!important;}
#content.login{background:var(--card)!important;border:1px solid var(--border)!important;border-radius:var(--radius)!important;padding:22px!important;box-shadow:0 4px 14px rgba(0,0,0,.04)!important;float:none!important;width:auto!important;margin:0!important;}

.headline{text-align:center;margin:8px 0 18px;}
.headline .f18{font-size:22px!important;font-weight:700!important;color:#dc2626!important;}
.card{background:#fff;border:1px solid var(--border);border-radius:12px;padding:16px;margin-bottom:14px;}
.btn{display:inline-block;background:var(--primary);color:#fff;border:0;padding:10px 18px;border-radius:10px;font-weight:600;cursor:pointer;text-decoration:none;box-shadow:0 6px 16px rgba(22,163,74,.2);}
.btn:hover{filter:brightness(1.05);}
.input{width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:10px;font-size:14px;background:#fff;}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:900px){#mid{grid-template-columns:1fr!important;}.tz-header{margin:12px 16px 0;}}

/* STEPPER */
.stepper{display:flex;flex-direction:column;gap:8px;}
.step{display:flex!important;align-items:center!important;gap:10px!important;padding:8px 10px!important;border-radius:10px!important;color:#334155!important;position:static!important;}
.step .num{width:28px!important;height:28px!important;min-width:28px!important;border-radius:50%!important;display:flex!important;align-items:center!important;justify-content:center!important;background:#e2e8f0!important;color:#334155!important;font-weight:700!important;font-size:13px!important;position:static!important;}
.step.active{background:#ecfdf5!important;color:#065f46!important;}
.step.active .num{background:#16a34a!important;color:#fff!important;}
.step.done{color:#166534!important;}
.step.done .num{background:#bbf7d0!important;color:#166534!important;}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
  // HEADER
  var h = document.createElement('div');
  h.className = 'tz-header';
  h.innerHTML = `
    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M32 4L8 14v14c0 13.5 9.3 26.1 24 30 14.7-3.9 24-16.5 24-30V14L32 4z" fill="url(#g)"/>
      <path d="M32 8l20 8v12c0 11.2-7.7 21.7-20 25-12.3-3.3-20-13.8-20-25V16l20-8z" fill="#16a34a" opacity=".9"/>
      <path d="M26 32l5 5 11-11" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
      <defs><linearGradient id="g" x1="8" y1="4" x2="56" y2="58"><stop stop-color="#22c55e"/><stop offset="1" stop-color="#0f172a"/></linearGradient></defs>
    </svg>
    <div><h1>TravianZ Installation</h1><p>Setup wizard • v.9.0 Incremental Refactor</p></div>
  `;
  var wrap = document.querySelector('.wrapper');
  if(wrap) wrap.parentNode.insertBefore(h, wrap);

  // FOOTER
  var f = document.createElement('div');
  f.className = 'tz-footer';
  f.innerHTML = `<div>© 2010 - 2026 TravianZ • All rights reserved</div><div>Server running on <b>v.9.0 Incremental Refactor</b></div>`;
  document.body.appendChild(f);

  // curăță resturi vechi
  document.querySelectorAll('img, div, footer').forEach(el=>{
    if(el.textContent && el.textContent.includes('TRAVIANGAMES')) el.style.display='none';
  });
});
</script>

<?php
class IHG_Progressbar {
    protected $bar_id; protected $max_ticks; protected $ticks; protected $label;
    public function __construct($max_ticks, $label = 'Step %d from %d') {
        $this->bar_id = uniqid('pb'); $this->label = $label;
        $this->max_ticks = $max_ticks; $this->ticks = 0;
    }
    public function tick(){ $this->ticks++; $this->draw_progress(); }
    public function draw(){ $this->draw_bar(); $this->draw_progress(); }
    static public function draw_css(){
        echo '<style>.ihg_wrap{margin:8px 0 18px}.ihg_bar{height:10px;background:#e5e7eb;border-radius:999px;overflow:hidden}.ihg_fill{height:100%;width:0;background:linear-gradient(90deg,#22c55e,#16a34a);transition:width .3s}.ihg_lab{font-size:12px;color:#64748b;margin-top:6px;text-align:center}</style>';
    }
    protected function draw_bar(){
        echo '<div class="ihg_wrap"><div class="ihg_bar"><div class="ihg_fill" id="'.$this->bar_id.'"></div></div><div class="ihg_lab" id="'.$this->bar_id.'_l"></div></div>';
        echo '<script>(function(){var b=document.getElementById("'.$this->bar_id.'"),l=document.getElementById("'.$this->bar_id.'_l");window["'.$this->bar_id.'"]=function(w,t){b.style.width=w+"%";l.textContent=t}})();</script>';
        $this->flush();
    }
    protected function draw_progress(){
        $w = round($this->ticks/$this->max_ticks*100,2);
        $t = sprintf($this->label,$this->ticks,$this->max_ticks);
        echo '<script>window["'.$this->bar_id.'"]("'.$w.'","'.addslashes($t).'");</script>'; $this->flush();
    }
    protected function flush(){ while(ob_get_level()>0){ob_end_flush();} flush(); }
}
?>