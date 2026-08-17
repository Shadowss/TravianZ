# Arabic asset inventory

Arabic uses `gpack/travian_default/lang/ar/rtl.css` to replace the text baked
into the legacy image controls with Arabic SVG/CSS fallbacks. The fallback is
also imported by the T4 pack. No source asset was renamed, so existing pack
references remain valid.

## Replaced at runtime

| Legacy asset group | Arabic fallback |
| --- | --- |
| `gpack/*/lang/en/b/{login,signup,ok,reply,send,save,delete,archiv,train,demolish,search}.gif` | `button-action.svg` (CSS text: تنفيذ) |
| `gpack/*/lang/en/b/back.gif` | `button-back.svg` (رجوع) |
| `gpack/*/lang/en/b/forward.gif` | `button-next.svg` (متابعة) |
| `gpack/*/lang/en/f/{newforum,post,reply,vote,result,voting}.gif` | Arabic action fallback |

## Needs a designed Arabic replacement

These files are text-bearing or language-labelled imagery; they are listed for
design work rather than silently renamed:

| Path or group | Why it needs review |
| --- | --- |
| `gpack/*/lang/en/a/{travian0,travian1}.gif`, `img/en/a/travian0.gif` | Brand/logo text |
| `gpack/*/lang/en/t1/{login,anmelden,passwort}.gif` | Page-title text |
| `gpack/*/lang/en/t2/{u04,u05,u06,u07,u22}.gif` | UI label text |
| `gpack/*/lang/en/msg/{block_bg24a,block_bg24b}.gif` | Message label text |
| `gpack/*/lang/en/p/{autovv,bfilter,dorf3,p1,p3,p4,p5,p6,p7,p8,sort,st1,xxl_map}.{gif,jpg,png}` | Product/tutorial screenshots with UI text |
| `img/en/s/*.png`, `img/en/tut/*`, `img/en/welten/*` | Landing-page screenshots and world labels |
| `img/t4n/Teaser_Prelandingpage_EN.png` | Explicit English teaser artwork |
| `gpack/travian/images/*-ltr.*`, `gpack/travian_default/images/*-ltr.*` | Directional artwork that should be mirrored or redrawn for RTL |
| `img/bezahlung/*.jpg` | Payment/package graphics with likely baked labels |

Use the accompanying mapping example only after final Arabic brand filenames
and replacement artwork are supplied; it intentionally makes no destructive
renames on its own.
