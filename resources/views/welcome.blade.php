<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Groupe Scout Saint Nicolas</title>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
<style>
:root{--jaune:#F5C400;--bleu:#1B4F9B;--bleu-fonce:#0D2E5A;--bleu-clair:#2E6FCC;--vert:#2A8C4A;--rouge:#C0392B;--blanc:#FFFFFF;--gris-clair:#F4F6F9;--gris:#6C757D;--ombre:0 4px 24px rgba(27,79,155,.12);--ombre-forte:0 8px 40px rgba(27,79,155,.22);}
*{margin:0;padding:0;box-sizing:border-box;}html{scroll-behavior:smooth;}
body{font-family:'Raleway',sans-serif;background:var(--gris-clair);color:#1a1a2e;overflow-x:hidden;}
/* NAV */
nav{position:fixed;top:0;left:0;right:0;z-index:1000;background:var(--bleu-fonce);box-shadow:0 2px 20px rgba(0,0,0,.4);display:flex;align-items:center;justify-content:space-between;padding:0 2rem;height:68px;}
.nav-brand{display:flex;align-items:center;gap:12px;cursor:pointer;}
.nav-logo{width:52px;height:52px;flex-shrink:0;overflow:hidden;}
.nav-logo img{width:52px;height:52px;object-fit:contain;}
.nav-title{font-family:'Cinzel',serif;font-size:1rem;font-weight:700;color:var(--blanc);line-height:1.2;}
.nav-title span{color:var(--jaune);}
.nav-links{display:flex;gap:.2rem;list-style:none;align-items:center;}
.nav-links li a{color:rgba(255,255,255,.82);font-size:.8rem;font-weight:600;letter-spacing:.07em;text-transform:uppercase;padding:.45rem .85rem;border-radius:6px;transition:all .2s;cursor:pointer;}
.nav-links li a:hover{background:rgba(245,196,0,.15);color:var(--jaune);}
.nav-cta{background:var(--jaune)!important;color:var(--bleu-fonce)!important;border-radius:20px!important;padding:.45rem 1.2rem!important;font-weight:700!important;}
.nav-cta:hover{background:#ffe066!important;}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:8px;}
.hamburger span{display:block;width:24px;height:2px;background:var(--blanc);border-radius:2px;transition:all .3s;}
.hamburger.open span:nth-child(1){transform:rotate(45deg) translate(5px,5px);}
.hamburger.open span:nth-child(2){opacity:0;}
.hamburger.open span:nth-child(3){transform:rotate(-45deg) translate(5px,-5px);}
.mobile-menu{display:none;position:fixed;top:68px;left:0;right:0;z-index:999;background:var(--bleu-fonce);padding:1rem 2rem 1.5rem;flex-direction:column;gap:.5rem;box-shadow:0 10px 30px rgba(0,0,0,.4);}
.mobile-menu.open{display:flex;}
.mobile-menu a{color:rgba(255,255,255,.85);font-size:.9rem;font-weight:600;padding:.7rem 0;border-bottom:1px solid rgba(255,255,255,.08);text-transform:uppercase;letter-spacing:.06em;cursor:pointer;}
.mobile-menu a:last-child{border:none;margin-top:.5rem;background:var(--jaune);color:var(--bleu-fonce);text-align:center;border-radius:10px;padding:.7rem;}
/* PAGES */
.page{display:none;}.page.active{display:block;}
/* PAGE HERO BANNER */
.page-hero{background:linear-gradient(135deg,var(--bleu-fonce),var(--bleu));padding:4rem 2rem 3rem;text-align:center;}
.page-hero .section-title{color:#fff;margin-bottom:.5rem;}
.page-hero p{color:rgba(255,255,255,.75);max-width:560px;margin:0 auto;font-size:1rem;}
/* HERO HOME */
.hero{min-height:100vh;background:linear-gradient(135deg,var(--bleu-fonce) 0%,var(--bleu) 55%,var(--bleu-clair) 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;position:relative;overflow:hidden;padding:80px 2rem 4rem;}
.hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23F5C400' fill-opacity='0.05'%3E%3Cpath d='M40 0L50 20L70 10L60 30L80 40L60 50L70 70L50 60L40 80L30 60L10 70L20 50L0 40L20 30L10 10L30 20Z'/%3E%3C/g%3E%3C/svg%3E") 0 0/80px;animation:driftP 30s linear infinite;}
@keyframes driftP{to{background-position:80px 80px}}
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
@keyframes bounce{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(8px)}}
.hero-logo-img{width:150px;height:auto;filter:drop-shadow(0 6px 20px rgba(0,0,0,.4));position:relative;z-index:1;animation:fadeUp .5s ease both;margin-bottom:1.2rem;}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(245,196,0,.18);border:1px solid rgba(245,196,0,.4);border-radius:30px;padding:.45rem 1.4rem;font-size:.78rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--jaune);margin-bottom:1.6rem;position:relative;z-index:1;animation:fadeUp .6s ease .1s both;}
.hero h1{font-family:'Cinzel',serif;font-size:clamp(2.2rem,5vw,4rem);font-weight:900;color:var(--blanc);line-height:1.08;position:relative;z-index:1;animation:fadeUp .7s ease .15s both;text-shadow:0 4px 30px rgba(0,0,0,.3);}
.hero h1 span{color:var(--jaune);}
.hero-sub{font-size:1.1rem;color:rgba(255,255,255,.75);margin:1rem 0 2.2rem;max-width:560px;position:relative;z-index:1;animation:fadeUp .7s ease .2s both;}
.hero-buttons{display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;position:relative;z-index:1;animation:fadeUp .7s ease .3s both;}
.hero-scroll{position:absolute;bottom:1.5rem;left:50%;transform:translateX(-50%);color:rgba(255,255,255,.5);font-size:.75rem;display:flex;flex-direction:column;align-items:center;gap:6px;animation:bounce 2s ease infinite;}
/* STATS */
.stats-band{background:var(--jaune);padding:1.5rem 2rem;display:flex;justify-content:center;gap:3rem;flex-wrap:wrap;}
.stat-item{text-align:center;}
.stat-num{font-family:'Cinzel',serif;font-size:2rem;font-weight:900;color:var(--bleu-fonce);}
.stat-label{font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--bleu-fonce);opacity:.7;}
/* LAYOUT */
section{padding:4rem 2rem;}.container{max-width:1200px;margin:0 auto;}
.section-title{font-family:'Cinzel',serif;font-size:2rem;font-weight:700;color:var(--bleu-fonce);text-align:center;margin-bottom:.6rem;}
.section-title span{color:var(--jaune);}
.section-sub{text-align:center;color:var(--gris);font-size:.98rem;margin-bottom:3rem;}
.section-bar{width:60px;height:4px;background:linear-gradient(90deg,var(--jaune),var(--bleu-clair));border-radius:2px;margin:.6rem auto 1.5rem;}
/* BTNS */
.btn-primary{background:var(--jaune);color:var(--bleu-fonce);border:none;border-radius:30px;padding:.85rem 2.2rem;font-family:'Raleway',sans-serif;font-size:.95rem;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all .25s;box-shadow:0 6px 20px rgba(245,196,0,.4);}
.btn-primary:hover{background:#ffe066;transform:translateY(-2px);}
.btn-outline{background:transparent;color:var(--blanc);border:2px solid rgba(255,255,255,.5);border-radius:30px;padding:.85rem 2.2rem;font-family:'Raleway',sans-serif;font-size:.95rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all .25s;}
.btn-outline:hover{border-color:var(--jaune);color:var(--jaune);}
.btn-sm{padding:.5rem 1.2rem!important;font-size:.82rem!important;border-radius:20px!important;}
.btn-bleu{background:var(--bleu);color:#fff;border:none;border-radius:8px;padding:.6rem 1.3rem;font-family:'Raleway',sans-serif;font-size:.85rem;font-weight:700;cursor:pointer;transition:all .2s;}
.btn-bleu:hover{background:var(--bleu-clair);}
.btn-danger{background:#e74c3c;color:#fff;border:none;border-radius:8px;padding:.5rem 1rem;font-family:'Raleway',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s;}
.btn-danger:hover{background:#c0392b;}
/* UNITES */
.unites-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:1.5rem;}
.unite-card{border-radius:18px;padding:2rem 1.5rem;text-align:center;position:relative;overflow:hidden;cursor:pointer;transition:transform .3s,box-shadow .3s;box-shadow:var(--ombre);}
.unite-card::before{content:'';position:absolute;top:-30px;right:-30px;width:100px;height:100px;border-radius:50%;opacity:.15;transition:all .4s;}
.unite-card:hover{transform:translateY(-6px);box-shadow:var(--ombre-forte);}
.unite-card:hover::before{transform:scale(2.5);}
.u-meute{background:linear-gradient(135deg,#fffbe6,#fff3b0);border-top:5px solid var(--jaune);}
.u-meute::before{background:var(--jaune);}
.u-troupe{background:linear-gradient(135deg,#eafaf1,#c3f0d0);border-top:5px solid var(--vert);}
.u-troupe::before{background:var(--vert);}
.u-grappe{background:linear-gradient(135deg,#eaf1fb,#b3cff5);border-top:5px solid var(--bleu);}
.u-grappe::before{background:var(--bleu);}
.u-route{background:linear-gradient(135deg,#fdf0ef,#f5c0bb);border-top:5px solid var(--rouge);}
.u-route::before{background:var(--rouge);}
.u-amical{background:linear-gradient(135deg,#f0f0f0,#dcdcdc);border-top:5px solid #555;}
.u-amical::before{background:#555;}
.unite-icon{font-size:2.8rem;margin-bottom:.8rem;display:block;}.unite-icon i{vertical-align:middle;}
.fa-icon-sm{font-size:.85em;width:1.1em;text-align:center;display:inline-block;}
.unite-name{font-family:'Cinzel',serif;font-size:1.1rem;font-weight:700;margin-bottom:.4rem;color:#1a1a2e;}
.unite-age{font-size:.8rem;font-weight:600;border-radius:12px;padding:.3rem .9rem;display:inline-block;margin-bottom:.7rem;}
.u-meute .unite-age{background:var(--jaune);color:var(--bleu-fonce);}
.u-troupe .unite-age{background:var(--vert);color:#fff;}
.u-grappe .unite-age{background:var(--bleu);color:#fff;}
.u-route .unite-age{background:var(--rouge);color:#fff;}
.u-amical .unite-age{background:#555;color:#fff;}
.unite-desc{font-size:.84rem;color:var(--gris);line-height:1.5;}
/* UNITE DETAIL PAGE */
.unite-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;}
.unite-detail-card{border-radius:24px;padding:2.5rem;text-align:center;border-width:3px;border-style:solid;}
.unite-color-dot{width:60px;height:60px;border-radius:50%;margin:0 auto 1rem;border:4px solid white;}
.unite-tag{border-radius:10px;padding:.3rem .8rem;font-size:.8rem;font-weight:600;border-width:1.5px;border-style:solid;display:inline-block;}
.unite-stat-box{background:rgba(27,79,155,.07);border-radius:8px;padding:.5rem 1rem;font-size:.82rem;font-weight:600;color:var(--bleu-fonce);display:inline-block;margin-top:.8rem;}
/* PUBLICATIONS */
.pub-toolbar{display:flex;gap:.8rem;flex-wrap:wrap;align-items:center;margin-bottom:1.5rem;justify-content:space-between;}
.pub-toolbar-left{display:flex;gap:.5rem;flex-wrap:wrap;}
.pub-tab{background:var(--blanc);border:2px solid transparent;border-radius:24px;padding:.5rem 1.3rem;font-family:'Raleway',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s;color:var(--gris);}
.pub-tab.active,.pub-tab:hover{background:var(--bleu);color:var(--blanc);border-color:var(--bleu);}
.pub-search{border:2px solid #dde3ef;border-radius:24px;padding:.5rem 1.2rem;font-family:'Raleway',sans-serif;font-size:.85rem;outline:none;min-width:200px;transition:border-color .2s;}
.pub-search:focus{border-color:var(--bleu-clair);}
.pub-table-wrap{background:var(--blanc);border-radius:16px;box-shadow:var(--ombre);overflow:hidden;}
.pub-table{width:100%;border-collapse:collapse;font-size:.88rem;}
.pub-table thead{background:var(--bleu-fonce);color:var(--blanc);}
.pub-table th{padding:1rem 1.2rem;text-align:left;font-family:'Cinzel',serif;font-size:.8rem;letter-spacing:.05em;}
.pub-table td{padding:.9rem 1.2rem;border-bottom:1px solid #eef2f7;vertical-align:middle;}
.pub-table tbody tr:last-child td{border-bottom:none;}
.pub-table tbody tr:hover{background:#f0f6ff;}
.badge{display:inline-block;border-radius:12px;padding:.25rem .75rem;font-size:.74rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;}
.b-statut{background:#e8f4fd;color:var(--bleu);}
.b-reglement{background:#fdf3e8;color:#e67e22;}
.b-article{background:#eafaf1;color:var(--vert);}
.b-annonce{background:#fdeaea;color:var(--rouge);}
.empty-state{text-align:center;padding:3rem;color:var(--gris);}
.empty-state .empty-icon{font-size:3rem;display:block;margin-bottom:.8rem;}
.pub-count{font-size:.82rem;color:var(--gris);padding:.5rem 1.5rem;border-top:1px solid #eef2f7;}
/* GALERIE */
.galerie-toolbar{display:flex;gap:.8rem;flex-wrap:wrap;align-items:center;margin-bottom:1.5rem;justify-content:space-between;}
.galerie-filters{display:flex;gap:.5rem;flex-wrap:wrap;}
.galerie-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;}
.galerie-item{border-radius:14px;overflow:hidden;position:relative;aspect-ratio:4/3;cursor:pointer;box-shadow:var(--ombre);transition:transform .3s;background:#eee;}
.galerie-item:hover{transform:scale(1.03);}
.galerie-item:hover .galerie-overlay{opacity:1;}
.galerie-item img,.galerie-item video{width:100%;height:100%;object-fit:cover;}
.galerie-overlay{position:absolute;inset:0;background:rgba(27,79,155,.7);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;opacity:0;transition:opacity .3s;}
.galerie-overlay span{color:var(--blanc);font-size:.85rem;font-weight:600;}
.galerie-del-btn{background:rgba(231,76,60,.9);border:none;color:#fff;border-radius:6px;padding:.3rem .7rem;font-size:.75rem;cursor:pointer;font-weight:700;}
.upload-zone{border:2.5px dashed #c5d0e6;border-radius:14px;padding:2.5rem;text-align:center;color:var(--gris);cursor:pointer;transition:all .2s;background:#f8f9fe;}
.upload-zone:hover,.upload-zone.dragover{border-color:var(--bleu-clair);background:#eaf1fb;color:var(--bleu-fonce);}
.upload-zone .upload-icon{font-size:2.5rem;margin-bottom:.5rem;display:block;}
#fileInput{display:none;}
/* PUB FILE UPLOAD */
.pub-upload-zone{border:2px dashed #c5d0e6;border-radius:10px;padding:1.2rem;text-align:center;cursor:pointer;transition:all .2s;background:#f8f9fe;}
.pub-upload-zone:hover,.pub-upload-zone.dragover{border-color:var(--bleu-clair);background:#eaf1fb;}
.pub-file-list{display:flex;flex-direction:column;gap:.4rem;margin-top:.5rem;}
.pub-file-item{display:flex;align-items:center;gap:.6rem;padding:.45rem .7rem;background:var(--gris-clair);border-radius:8px;font-size:.82rem;}
.pub-file-item i.file-icon{font-size:1rem;color:var(--bleu);}
.pub-file-item .file-name{flex:1;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.pub-file-item .file-size{color:var(--gris);font-size:.75rem;}
.pub-file-item .file-remove{background:none;border:none;color:var(--rouge);cursor:pointer;font-size:.9rem;padding:2px 4px;border-radius:4px;}
.pub-file-item .file-remove:hover{background:#fdeaea;}
/* MEMBRES */
.membres-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.2rem;margin-top:1rem;}
.membre-card{background:var(--blanc);border-radius:16px;padding:1.5rem;box-shadow:var(--ombre);transition:transform .2s,box-shadow .2s;}
.membre-card:hover{transform:translateY(-3px);box-shadow:var(--ombre-forte);}
.membre-header{display:flex;align-items:center;gap:1rem;margin-bottom:1rem;}
.membre-avatar{width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.4rem;font-weight:900;color:#fff;flex-shrink:0;}
.membre-info h4{font-family:'Cinzel',serif;font-size:.95rem;color:var(--bleu-fonce);}
.membre-info p{font-size:.8rem;color:var(--gris);margin-top:2px;}
.membre-details{display:flex;flex-direction:column;gap:.4rem;font-size:.82rem;color:#444;}
.membre-actions{display:flex;gap:.5rem;margin-top:1rem;padding-top:1rem;border-top:1px solid #eef2f7;flex-wrap:wrap;}
.statut-badge{display:inline-flex;align-items:center;gap:4px;border-radius:10px;padding:.2rem .7rem;font-size:.73rem;font-weight:700;}
.statut-actif{background:#eafaf1;color:var(--vert);}
.statut-attente{background:#fdf3e8;color:#e67e22;}
.statut-inactif{background:#f5f5f5;color:#888;}
.membres-toolbar{display:flex;gap:.8rem;flex-wrap:wrap;align-items:center;justify-content:space-between;margin-bottom:1rem;}
/* INSCRIPTION */
.form-card{background:var(--blanc);border-radius:22px;box-shadow:var(--ombre-forte);overflow:hidden;max-width:860px;margin:0 auto;}
.form-header{background:linear-gradient(135deg,var(--bleu-fonce),var(--bleu));padding:2.5rem;text-align:center;}
.form-header h3{font-family:'Cinzel',serif;font-size:1.5rem;color:var(--blanc);margin-bottom:.4rem;}
.form-header p{color:rgba(255,255,255,.7);font-size:.9rem;}
.form-body{padding:2.5rem;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;}
.form-group{display:flex;flex-direction:column;gap:.45rem;}
.form-group.full{grid-column:1/-1;}
label{font-size:.82rem;font-weight:700;color:var(--bleu-fonce);letter-spacing:.04em;text-transform:uppercase;}
input,select,textarea{border:1.5px solid #dde3ef;border-radius:10px;padding:.75rem 1rem;font-family:'Raleway',sans-serif;font-size:.92rem;color:#1a1a2e;background:var(--blanc);transition:border-color .2s,box-shadow .2s;outline:none;}
input:focus,select:focus,textarea:focus{border-color:var(--bleu-clair);box-shadow:0 0 0 3px rgba(46,111,204,.12);}
textarea{resize:vertical;min-height:90px;}
.unite-selector{display:grid;grid-template-columns:repeat(5,1fr);gap:.7rem;}
.unite-opt{display:none;}
.unite-opt-label{display:flex;flex-direction:column;align-items:center;gap:5px;border:2px solid #dde3ef;border-radius:12px;padding:.8rem .5rem;cursor:pointer;font-size:.75rem;font-weight:700;text-align:center;transition:all .2s;color:var(--gris);}
.unite-opt-label span{font-size:1.5rem;}
.unite-opt:checked + .unite-opt-label{border-color:var(--bleu-clair);background:#eaf1fb;color:var(--bleu-fonce);box-shadow:0 2px 10px rgba(46,111,204,.2);}
.form-submit{width:100%;padding:1rem 2rem;background:linear-gradient(135deg,var(--bleu-fonce),var(--bleu));color:var(--blanc);border:none;border-radius:12px;font-family:'Cinzel',serif;font-size:1rem;font-weight:700;cursor:pointer;margin-top:1.5rem;transition:all .3s;box-shadow:0 4px 18px rgba(27,79,155,.35);letter-spacing:.05em;}
.form-submit:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(27,79,155,.5);}
/* MODAL */
.modal-overlay{position:fixed;inset:0;z-index:2000;background:rgba(13,46,90,.75);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .3s;padding:1rem;}
.modal-overlay.open{opacity:1;pointer-events:all;}
.modal{background:var(--blanc);border-radius:20px;padding:2.5rem;width:100%;max-width:600px;max-height:90vh;overflow-y:auto;transform:translateY(20px);transition:transform .3s;box-shadow:0 20px 60px rgba(13,46,90,.4);position:relative;}
.modal-overlay.open .modal{transform:translateY(0);}
.modal h2{font-family:'Cinzel',serif;font-size:1.3rem;color:var(--bleu-fonce);margin-bottom:1.5rem;padding-right:2rem;}
.modal-close{position:absolute;top:1.2rem;right:1.2rem;background:none;border:none;font-size:1.4rem;cursor:pointer;color:var(--gris);width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:all .2s;}
.modal-close:hover{color:var(--rouge);background:#fdeaea;}
.modal-footer{display:flex;gap:.8rem;margin-top:1.5rem;justify-content:flex-end;}
.modal-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.modal-grid .full{grid-column:1/-1;}
/* LIGHTBOX */
.lightbox{position:fixed;inset:0;z-index:3000;background:rgba(0,0,0,.95);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .3s;}
.lightbox.open{opacity:1;pointer-events:all;}
.lightbox img,.lightbox video{max-width:90vw;max-height:85vh;border-radius:10px;object-fit:contain;}
.lightbox-close{position:absolute;top:1.5rem;right:1.5rem;background:rgba(255,255,255,.15);border:none;color:#fff;font-size:1.5rem;width:44px;height:44px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;}
.lightbox-close:hover{background:rgba(255,255,255,.3);}
.lightbox-info{position:absolute;bottom:1.5rem;left:50%;transform:translateX(-50%);color:rgba(255,255,255,.8);font-size:.85rem;text-align:center;}
/* TOAST */
.toast{position:fixed;bottom:2rem;right:2rem;z-index:4000;background:var(--bleu-fonce);color:var(--blanc);border-left:4px solid var(--jaune);border-radius:10px;padding:1rem 1.5rem;font-size:.9rem;font-weight:600;box-shadow:0 8px 30px rgba(13,46,90,.4);transform:translateX(140%);transition:transform .35s;max-width:340px;}
.toast.show{transform:translateX(0);}
.toast.success{border-left-color:var(--vert);}
.toast.error{border-left-color:var(--rouge);}
.toast.warning{border-left-color:var(--jaune);}
/* FOOTER */
footer{background:var(--bleu-fonce);color:rgba(255,255,255,.75);padding:3.5rem 2rem 2rem;}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr;gap:3rem;max-width:1200px;margin:0 auto;padding-bottom:2rem;border-bottom:1px solid rgba(255,255,255,.12);}
.footer-brand h3{font-family:'Cinzel',serif;font-size:1.1rem;color:var(--blanc);margin-bottom:.8rem;}
.footer-brand h3 span{color:var(--jaune);}
.footer-brand p{font-size:.85rem;line-height:1.7;}
.footer-col h4{font-family:'Cinzel',serif;font-size:.9rem;color:var(--blanc);margin-bottom:1rem;}
.footer-col ul{list-style:none;}
.footer-col ul li{margin-bottom:.55rem;}
.footer-col ul li a{color:rgba(255,255,255,.65);font-size:.85rem;cursor:pointer;}
.footer-col ul li a:hover{color:var(--jaune);}
.footer-bottom{max-width:1200px;margin:1.5rem auto 0;display:flex;justify-content:space-between;align-items:center;font-size:.8rem;color:rgba(255,255,255,.4);flex-wrap:wrap;gap:.5rem;}
.footer-unites{display:flex;gap:.5rem;flex-wrap:wrap;margin-top:1rem;align-items:center;}
.footer-unite-dot{width:12px;height:12px;border-radius:50%;display:inline-block;}
::-webkit-scrollbar{width:8px;}::-webkit-scrollbar-track{background:var(--gris-clair);}::-webkit-scrollbar-thumb{background:var(--bleu-clair);border-radius:4px;}
@media(max-width:900px){.unite-detail-grid{grid-template-columns:1fr;}}
@media(max-width:768px){
  nav{padding:0 1rem;}.nav-links{display:none;}.hamburger{display:flex;}
  .form-grid,.modal-grid{grid-template-columns:1fr;}.form-group.full,.modal-grid .full{grid-column:1;}
  .unite-selector{grid-template-columns:repeat(3,1fr);}
  .footer-grid{grid-template-columns:1fr;gap:2rem;}.footer-bottom{flex-direction:column;text-align:center;}
  .pub-toolbar,.galerie-toolbar,.membres-toolbar{flex-direction:column;align-items:stretch;}
  .pub-toolbar-left,.galerie-filters{justify-content:center;}.pub-search{width:100%;}
  .stats-band{gap:1.5rem;}
}
</style>
</head>
<body>

<nav>
  <div class="nav-brand" data-nav="accueil">
    <div class="nav-logo"><img src="{{ asset('images/logo-gsn.png') }}" alt="GSN"></div>
    <div class="nav-title">Groupe Scout<br><span>Saint Nicolas</span></div>
  </div>
  <ul class="nav-links">
    <li><a data-nav="accueil">Accueil</a></li>
    <li><a data-nav="unites">Unités</a></li>
    <li><a data-nav="publications">Publications</a></li>
    <li><a data-nav="galerie">Galerie</a></li>
    <li><a data-nav="membres">Membres</a></li>
    <li><a data-nav="inscription" class="nav-cta"><i class="fa-solid fa-star"></i> S'inscrire</a></li>
  </ul>
  <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
</nav>
<div class="mobile-menu" id="mobileMenu">
  <a data-nav="accueil"><i class="fa-solid fa-house"></i> Accueil</a>
  <a data-nav="unites"><i class="fa-solid fa-tent"></i> Unités</a>
  <a data-nav="publications"><i class="fa-solid fa-clipboard-list"></i> Publications</a>
  <a data-nav="galerie"><i class="fa-solid fa-images"></i> Galerie</a>
  <a data-nav="membres"><i class="fa-solid fa-users"></i> Membres</a>
  <a data-nav="inscription"><i class="fa-solid fa-star"></i> S'inscrire</a>
</div>

<!-- ===== PAGE ACCUEIL ===== -->
<div class="page active" id="page-accueil">
  <div class="hero">
    <img src="{{ asset('images/logo-gsn.png') }}" class="hero-logo-img" alt="Logo GSN">
    <div class="hero-badge"><span><i class="fa-solid fa-fleur-de-lis"></i></span> Service · Fraternité · Honneur <span><i class="fa-solid fa-fleur-de-lis"></i></span></div>
    <h1>Groupe Scout<br><span>Saint Nicolas</span></h1>
    <p class="hero-sub">Un mouvement de jeunesse uni par les valeurs du scoutisme — courage, fraternité, service et dépassement de soi.</p>
    <div class="hero-buttons">
      <button class="btn-primary" data-nav="inscription"><i class="fa-solid fa-star"></i> Rejoindre le groupe</button>
      <button class="btn-outline" data-nav="unites">Découvrir nos unités →</button>
    </div>
    <div class="hero-scroll"><span>↓</span><span style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase">Explorer</span></div>
  </div>
  <div class="stats-band">
    <div class="stat-item"><div class="stat-num" id="stat-membres">0</div><div class="stat-label">Membres actifs</div></div>
    <div class="stat-item"><div class="stat-num">5</div><div class="stat-label">Unités</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-pubs">0</div><div class="stat-label">Publications</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-photos">0</div><div class="stat-label">Photos & Vidéos</div></div>
  </div>
  <section style="background:var(--blanc);">
    <div class="container">
      <div class="section-title">Nos <span>Unités</span></div>
      <div class="section-bar"></div>
      <p class="section-sub">5 unités pour accompagner chaque jeune selon son âge</p>
      <div class="unites-grid">
        <div class="unite-card u-meute" data-nav="unites"><span class="unite-icon"><i class="fa-solid fa-paw"></i></span><div class="unite-name">Meute</div><div class="unite-age">6 – 11 ans</div><p class="unite-desc">Les louvetaux découvrent le scoutisme à travers le jeu et l'aventure.</p></div>
        <div class="unite-card u-troupe" data-nav="unites"><span class="unite-icon"><i class="fa-solid fa-campground"></i></span><div class="unite-name">Troupe</div><div class="unite-age">12 – 17 ans</div><p class="unite-desc">Les scouts développent leur autonomie et leur esprit d'équipe.</p></div>
        <div class="unite-card u-grappe" data-nav="unites"><span class="unite-icon"><i class="fa-solid fa-leaf"></i></span><div class="unite-name">Grappe</div><div class="unite-age">17 – 20 ans</div><p class="unite-desc">Les pionniers s'engagent dans des actions de service communautaire.</p></div>
        <div class="unite-card u-route" data-nav="unites"><span class="unite-icon"><i class="fa-solid fa-map"></i></span><div class="unite-name">Route</div><div class="unite-age">20 – 23 ans</div><p class="unite-desc">Les routiers s'engagent dans un cheminement de service altruiste.</p></div>
        <div class="unite-card u-amical" data-nav="unites"><span class="unite-icon"><i class="fa-solid fa-handshake"></i></span><div class="unite-name">Amical</div><div class="unite-age">23 ans et +</div><p class="unite-desc">Les adultes qui accompagnent et soutiennent le groupe.</p></div>
      </div>
      <div style="text-align:center;margin-top:2.5rem">
        <button class="btn-primary" data-nav="unites">En savoir plus sur nos unités →</button>
      </div>
    </div>
  </section>
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <h3>Groupe Scout <span>Saint Nicolas</span></h3>
        <p>Un mouvement engagé pour former des citoyens responsables, courageux et fraternels, au service de leur communauté.</p>
        <div class="footer-unites">
          <span class="footer-unite-dot" style="background:#F5C400"></span>
          <span class="footer-unite-dot" style="background:#2A8C4A"></span>
          <span class="footer-unite-dot" style="background:#1B4F9B"></span>
          <span class="footer-unite-dot" style="background:#C0392B"></span>
          <span class="footer-unite-dot" style="background:#555"></span>
          <span style="font-size:.78rem;margin-left:4px;color:rgba(255,255,255,.4)">5 Unités actives</span>
        </div>
      </div>
      <div class="footer-col"><h4>Navigation</h4><ul>
        <li><a data-nav="unites">Nos Unités</a></li>
        <li><a data-nav="publications">Publications</a></li>
        <li><a data-nav="galerie">Galerie</a></li>
        <li><a data-nav="membres">Membres</a></li>
        <li><a data-nav="inscription">S'inscrire</a></li>
      </ul></div>
      <div class="footer-col"><h4>Contact</h4><ul>
        <li><a><i class="fa-solid fa-location-dot"></i> Burundi</a></li>
        <li><a><i class="fa-solid fa-envelope"></i> gsaintn@gmail.com</a></li>
        <li><a><i class="fa-solid fa-phone"></i> +257 XX XXX XXX</a></li>
      </ul></div>
    </div>
    <div class="footer-bottom">
      <span>© 2025 Groupe Scout Saint Nicolas · Tous droits réservés</span>
      <a href="{{ url('/login') }}" style="color:rgba(255,255,255,.4);text-decoration:none;font-size:.78rem;"><i class="fa-solid fa-lock"></i> Administration</a>
      <span><i class="fa-solid fa-fleur-de-lis"></i> Toujours prêts</span>
    </div>
  </footer>
</div>

<!-- ===== PAGE UNITÉS ===== -->
<div class="page" id="page-unites" style="padding-top:68px;min-height:100vh;">
  <div class="page-hero">
    <div class="section-title" style="color:#fff">Nos <span>Unités</span></div>
    <div class="section-bar"></div>
    <p>5 unités pour accompagner chaque scout de 6 ans jusqu'à l'âge adulte.</p>
  </div>

  <!-- MEUTE -->
  <section style="background:var(--blanc);">
    <div class="container">
      <div class="unite-detail-grid">
        <div>
          <div style="display:inline-flex;align-items:center;gap:.8rem;background:#fffbe6;border-radius:14px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
            <span style="font-size:3rem"><i class="fa-solid fa-paw"></i></span>
            <div>
              <div style="font-family:Cinzel,serif;font-size:1.4rem;font-weight:900;color:var(--bleu-fonce)">Unité Meute</div>
              <span style="background:var(--jaune);color:var(--bleu-fonce);border-radius:12px;padding:.2rem .8rem;font-size:.8rem;font-weight:700">6 – 11 ans</span>
            </div>
          </div>
          <p style="line-height:1.8;color:#444;margin-bottom:1rem">La <strong>Meute</strong> est l'unité des plus jeunes scouts, les <em>louvetaux</em>. Inspirée du Livre de la Jungle de Rudyard Kipling, elle offre aux enfants un cadre ludique et éducatif pour découvrir les valeurs du scoutisme.</p>
          <p style="line-height:1.8;color:#444;margin-bottom:1.5rem">Les louvetaux apprennent la vie en groupe, la solidarité, l'entraide et les premiers gestes de service à travers des jeux, des activités manuelles et des sorties en plein air.</p>
          <div style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.5rem">
            <span class="unite-tag" style="background:#fffbe6;border-color:var(--jaune);color:#7a5800"><i class="fa-solid fa-gamepad"></i> Jeux collectifs</span>
            <span class="unite-tag" style="background:#fffbe6;border-color:var(--jaune);color:#7a5800"><i class="fa-solid fa-leaf"></i> Nature & découverte</span>
            <span class="unite-tag" style="background:#fffbe6;border-color:var(--jaune);color:#7a5800"><i class="fa-solid fa-handshake"></i> Solidarité</span>
            <span class="unite-tag" style="background:#fffbe6;border-color:var(--jaune);color:#7a5800"><i class="fa-solid fa-palette"></i> Activités manuelles</span>
          </div>
        </div>
        <div class="unite-detail-card u-meute" style="border-color:var(--jaune)">
          <div style="font-size:5rem;margin-bottom:1rem"><i class="fa-solid fa-paw"></i></div>
          <div style="font-family:Cinzel,serif;font-size:1rem;font-weight:700;color:var(--bleu-fonce);margin-bottom:.5rem">Couleur emblème</div>
          <div class="unite-color-dot" style="background:var(--jaune);box-shadow:0 4px 16px rgba(245,196,0,.4)"></div>
          <div style="font-weight:700;color:var(--bleu-fonce);font-size:1.1rem;margin-bottom:1rem">Jaune</div>
          <hr style="border-color:#ffe066;margin-bottom:1rem">
          <div style="font-size:.85rem;color:var(--gris);line-height:1.9">
            <div><strong>Chef d'unité :</strong> Akela</div>
            <div><strong>Réunions :</strong> Samedi matin</div>
            <div id="stat-meute-membres" class="unite-stat-box">Chargement...</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TROUPE -->
  <section style="background:var(--gris-clair);">
    <div class="container">
      <div class="unite-detail-grid">
        <div class="unite-detail-card u-troupe" style="border-color:var(--vert)">
          <div style="font-size:5rem;margin-bottom:1rem"><i class="fa-solid fa-campground"></i></div>
          <div style="font-family:Cinzel,serif;font-size:1rem;font-weight:700;color:var(--bleu-fonce);margin-bottom:.5rem">Couleur emblème</div>
          <div class="unite-color-dot" style="background:var(--vert);box-shadow:0 4px 16px rgba(42,140,74,.4)"></div>
          <div style="font-weight:700;color:var(--bleu-fonce);font-size:1.1rem;margin-bottom:1rem">Verte</div>
          <hr style="border-color:#a8e6c0;margin-bottom:1rem">
          <div style="font-size:.85rem;color:var(--gris);line-height:1.9">
            <div><strong>Chef d'unité :</strong> Chef Troupe</div>
            <div><strong>Réunions :</strong> Samedi après-midi</div>
            <div id="stat-troupe-membres" class="unite-stat-box">Chargement...</div>
          </div>
        </div>
        <div>
          <div style="display:inline-flex;align-items:center;gap:.8rem;background:#eafaf1;border-radius:14px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
            <span style="font-size:3rem"><i class="fa-solid fa-campground"></i></span>
            <div>
              <div style="font-family:Cinzel,serif;font-size:1.4rem;font-weight:900;color:var(--bleu-fonce)">Unité Troupe</div>
              <span style="background:var(--vert);color:#fff;border-radius:12px;padding:.2rem .8rem;font-size:.8rem;font-weight:700">12 – 17 ans</span>
            </div>
          </div>
          <p style="line-height:1.8;color:#444;margin-bottom:1rem">La <strong>Troupe</strong> accueille les <em>scouts</em> en pleine adolescence. C'est l'âge des grandes aventures, des camps en forêt, des projets collectifs et de la découverte de soi.</p>
          <p style="line-height:1.8;color:#444;margin-bottom:1.5rem">Organisée en patrouilles, la Troupe développe l'autonomie, le leadership et l'esprit d'équipe à travers des défis progressifs et des expériences en plein air.</p>
          <div style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.5rem">
            <span class="unite-tag" style="background:#eafaf1;border-color:var(--vert);color:#1a5c32"><i class="fa-solid fa-tent"></i> Camps & randonnées</span>
            <span class="unite-tag" style="background:#eafaf1;border-color:var(--vert);color:#1a5c32"><i class="fa-solid fa-compass"></i> Orientation & survie</span>
            <span class="unite-tag" style="background:#eafaf1;border-color:var(--vert);color:#1a5c32"><i class="fa-solid fa-trophy"></i> Leadership</span>
            <span class="unite-tag" style="background:#eafaf1;border-color:var(--vert);color:#1a5c32"><i class="fa-solid fa-wrench"></i> Techniques scouts</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- GRAPPE -->
  <section style="background:var(--blanc);">
    <div class="container">
      <div class="unite-detail-grid">
        <div>
          <div style="display:inline-flex;align-items:center;gap:.8rem;background:#eaf1fb;border-radius:14px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
            <span style="font-size:3rem"><i class="fa-solid fa-leaf"></i></span>
            <div>
              <div style="font-family:Cinzel,serif;font-size:1.4rem;font-weight:900;color:var(--bleu-fonce)">Unité Grappe</div>
              <span style="background:var(--bleu);color:#fff;border-radius:12px;padding:.2rem .8rem;font-size:.8rem;font-weight:700">17 – 20 ans</span>
            </div>
          </div>
          <p style="line-height:1.8;color:#444;margin-bottom:1rem">La <strong>Grappe</strong> réunit les <em>pionniers</em>, jeunes adultes qui s'engagent dans des projets de service ambitieux au profit de la communauté.</p>
          <p style="line-height:1.8;color:#444;margin-bottom:1.5rem">Les pionniers conçoivent et réalisent leurs propres projets : chantiers, actions humanitaires, formations. Ils développent leur sens des responsabilités et leur capacité à servir.</p>
          <div style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.5rem">
            <span class="unite-tag" style="background:#eaf1fb;border-color:var(--bleu);color:#0d2e5a"><i class="fa-solid fa-helmet-safety"></i> Projets communautaires</span>
            <span class="unite-tag" style="background:#eaf1fb;border-color:var(--bleu);color:#0d2e5a"><i class="fa-solid fa-lightbulb"></i> Innovation sociale</span>
            <span class="unite-tag" style="background:#eaf1fb;border-color:var(--bleu);color:#0d2e5a"><i class="fa-solid fa-earth-africa"></i> Service citoyen</span>
            <span class="unite-tag" style="background:#eaf1fb;border-color:var(--bleu);color:#0d2e5a"><i class="fa-solid fa-graduation-cap"></i> Formation</span>
          </div>
        </div>
        <div class="unite-detail-card u-grappe" style="border-color:var(--bleu)">
          <div style="font-size:5rem;margin-bottom:1rem"><i class="fa-solid fa-leaf"></i></div>
          <div style="font-family:Cinzel,serif;font-size:1rem;font-weight:700;color:var(--bleu-fonce);margin-bottom:.5rem">Couleur emblème</div>
          <div class="unite-color-dot" style="background:var(--bleu);box-shadow:0 4px 16px rgba(27,79,155,.4)"></div>
          <div style="font-weight:700;color:var(--bleu-fonce);font-size:1.1rem;margin-bottom:1rem">Bleue</div>
          <hr style="border-color:#b3cff5;margin-bottom:1rem">
          <div style="font-size:.85rem;color:var(--gris);line-height:1.9">
            <div><strong>Chef d'unité :</strong> Président Grappe</div>
            <div><strong>Réunions :</strong> Dimanche matin</div>
            <div id="stat-grappe-membres" class="unite-stat-box">Chargement...</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ROUTE -->
  <section style="background:var(--gris-clair);">
    <div class="container">
      <div class="unite-detail-grid">
        <div class="unite-detail-card u-route" style="border-color:var(--rouge)">
          <div style="font-size:5rem;margin-bottom:1rem"><i class="fa-solid fa-map"></i></div>
          <div style="font-family:Cinzel,serif;font-size:1rem;font-weight:700;color:var(--bleu-fonce);margin-bottom:.5rem">Couleur emblème</div>
          <div class="unite-color-dot" style="background:var(--rouge);box-shadow:0 4px 16px rgba(192,57,43,.4)"></div>
          <div style="font-weight:700;color:var(--bleu-fonce);font-size:1.1rem;margin-bottom:1rem">Rouge</div>
          <hr style="border-color:#f5c0bb;margin-bottom:1rem">
          <div style="font-size:.85rem;color:var(--gris);line-height:1.9">
            <div><strong>Chef d'unité :</strong> Chef de Route</div>
            <div><strong>Réunions :</strong> Dimanche après-midi</div>
            <div id="stat-route-membres" class="unite-stat-box">Chargement...</div>
          </div>
        </div>
        <div>
          <div style="display:inline-flex;align-items:center;gap:.8rem;background:#fdf0ef;border-radius:14px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
            <span style="font-size:3rem"><i class="fa-solid fa-map"></i></span>
            <div>
              <div style="font-family:Cinzel,serif;font-size:1.4rem;font-weight:900;color:var(--bleu-fonce)">Unité Route</div>
              <span style="background:var(--rouge);color:#fff;border-radius:12px;padding:.2rem .8rem;font-size:.8rem;font-weight:700">20 – 23 ans</span>
            </div>
          </div>
          <p style="line-height:1.8;color:#444;margin-bottom:1rem">La <strong>Route</strong> accompagne les <em>routiers</em> dans une démarche personnelle et spirituelle de service altruiste, au service des plus vulnérables.</p>
          <p style="line-height:1.8;color:#444;margin-bottom:1.5rem">Les routiers s'engagent dans des missions de longue durée, développent leur identité profonde et tracent leur propre chemin en restant ancrés dans les valeurs du mouvement scout.</p>
          <div style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.5rem">
            <span class="unite-tag" style="background:#fdf0ef;border-color:var(--rouge);color:#7a1a0f"><i class="fa-solid fa-road"></i> Chemin personnel</span>
            <span class="unite-tag" style="background:#fdf0ef;border-color:var(--rouge);color:#7a1a0f"><i class="fa-solid fa-heart"></i> Service altruiste</span>
            <span class="unite-tag" style="background:#fdf0ef;border-color:var(--rouge);color:#7a1a0f"><i class="fa-solid fa-dove"></i> Engagement spirituel</span>
            <span class="unite-tag" style="background:#fdf0ef;border-color:var(--rouge);color:#7a1a0f"><i class="fa-solid fa-hands-holding-heart"></i> Solidarité</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- AMICAL -->
  <section style="background:var(--blanc);">
    <div class="container">
      <div class="unite-detail-grid">
        <div>
          <div style="display:inline-flex;align-items:center;gap:.8rem;background:#f0f0f0;border-radius:14px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
            <span style="font-size:3rem"><i class="fa-solid fa-handshake"></i></span>
            <div>
              <div style="font-family:Cinzel,serif;font-size:1.4rem;font-weight:900;color:var(--bleu-fonce)">Unité Amical</div>
              <span style="background:#555;color:#fff;border-radius:12px;padding:.2rem .8rem;font-size:.8rem;font-weight:700">23 ans et +</span>
            </div>
          </div>
          <p style="line-height:1.8;color:#444;margin-bottom:1rem">L'<strong>Amical</strong> rassemble les adultes et anciens scouts qui souhaitent continuer à vivre les valeurs du scoutisme tout en soutenant activement le groupe.</p>
          <p style="line-height:1.8;color:#444;margin-bottom:1.5rem">Les membres de l'Amical assurent l'encadrement, la formation des chefs, le soutien logistique et financier, et transmettent leur expérience aux générations suivantes.</p>
          <div style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.5rem">
            <span class="unite-tag" style="background:#f0f0f0;border-color:#999;color:#333"><i class="fa-solid fa-chalkboard-user"></i> Encadrement</span>
            <span class="unite-tag" style="background:#f0f0f0;border-color:#999;color:#333"><i class="fa-solid fa-book-open"></i> Formation des chefs</span>
            <span class="unite-tag" style="background:#f0f0f0;border-color:#999;color:#333"><i class="fa-solid fa-landmark"></i> Gouvernance</span>
            <span class="unite-tag" style="background:#f0f0f0;border-color:#999;color:#333"><i class="fa-solid fa-link"></i> Réseau alumni</span>
          </div>
        </div>
        <div class="unite-detail-card u-amical" style="border-color:#999">
          <div style="font-size:5rem;margin-bottom:1rem"><i class="fa-solid fa-handshake"></i></div>
          <div style="font-family:Cinzel,serif;font-size:1rem;font-weight:700;color:var(--bleu-fonce);margin-bottom:.5rem">Couleur emblème</div>
          <div class="unite-color-dot" style="background:#555;box-shadow:0 4px 16px rgba(0,0,0,.2)"></div>
          <div style="font-weight:700;color:var(--bleu-fonce);font-size:1.1rem;margin-bottom:1rem">Grise</div>
          <hr style="border-color:#ccc;margin-bottom:1rem">
          <div style="font-size:.85rem;color:var(--gris);line-height:1.9">
            <div><strong>Responsable :</strong> Conseil de Groupe</div>
            <div><strong>Réunions :</strong> 1er dimanche du mois</div>
            <div id="stat-amical-membres" class="unite-stat-box">Chargement...</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <div style="background:linear-gradient(135deg,var(--bleu-fonce),var(--bleu));padding:4rem 2rem;text-align:center;">
    <div style="font-family:Cinzel,serif;font-size:1.8rem;font-weight:700;color:#fff;margin-bottom:1rem">Prêt à rejoindre l'aventure ?</div>
    <p style="color:rgba(255,255,255,.75);margin-bottom:2rem;max-width:480px;margin-left:auto;margin-right:auto">Choisissez votre unité et inscrivez-vous dès aujourd'hui. Toujours prêts !</p>
    <button class="btn-primary" data-nav="inscription"><i class="fa-solid fa-fleur-de-lis"></i> S'inscrire maintenant</button>
  </div>
</div>

<!-- ===== PAGE PUBLICATIONS ===== -->
<div class="page" id="page-publications" style="padding-top:68px;min-height:100vh;background:var(--gris-clair);">
  <div class="page-hero">
    <div class="section-title" style="color:#fff">Publications & <span>Documents</span></div>
    <div class="section-bar"></div>
    <p>Accédez aux statuts, règlements, articles et annonces officielles du Groupe Scout Saint Nicolas.</p>
  </div>
  <section><div class="container">
    <div class="pub-toolbar">
      <div class="pub-toolbar-left" id="pubFilterBtns">
        <button class="pub-tab active" data-filter="tous"><i class="fa-solid fa-clipboard-list"></i> Tous</button>
        <button class="pub-tab" data-filter="statut"><i class="fa-solid fa-scroll"></i> Statuts</button>
        <button class="pub-tab" data-filter="reglement"><i class="fa-solid fa-scale-balanced"></i> Règlements</button>
        <button class="pub-tab" data-filter="article"><i class="fa-solid fa-newspaper"></i> Articles</button>
        <button class="pub-tab" data-filter="annonce"><i class="fa-solid fa-bullhorn"></i> Annonces</button>
      </div>
      <div style="display:flex;gap:.8rem;flex-wrap:wrap;align-items:center;">
        <input type="text" class="pub-search" id="pubSearch" placeholder="Rechercher...">
        <button class="btn-primary btn-sm" id="btnNewPub">+ Nouvelle publication</button>
      </div>
    </div>
    <div class="pub-table-wrap">
      <table class="pub-table">
        <thead><tr><th>#</th><th>Titre</th><th>Type</th><th>Unité</th><th>Date</th><th>Auteur</th><th>Actions</th></tr></thead>
        <tbody id="pub-tbody"></tbody>
      </table>
      <div class="pub-count" id="pub-count"></div>
    </div>
  </div></section>
</div>

<!-- ===== PAGE GALERIE ===== -->
<div class="page" id="page-galerie" style="padding-top:68px;min-height:100vh;background:var(--blanc);">
  <div class="page-hero">
    <div class="section-title" style="color:#fff">Notre <span>Galerie</span></div>
    <div class="section-bar"></div>
    <p>Revivez les moments forts du groupe à travers nos photos et vidéos d'activités et de camps.</p>
  </div>
  <section><div class="container">
    <div class="galerie-toolbar">
      <div class="galerie-filters" id="galerieFilterBtns">
        <button class="pub-tab active" data-gfilter="tous"><i class="fa-solid fa-images"></i> Tous</button>
        <button class="pub-tab" data-gfilter="photo"><i class="fa-solid fa-camera"></i> Photos</button>
        <button class="pub-tab" data-gfilter="video"><i class="fa-solid fa-video"></i> Vidéos</button>
        <button class="pub-tab" data-gfilter="Meute"><i class="fa-solid fa-paw"></i> Meute</button>
        <button class="pub-tab" data-gfilter="Troupe"><i class="fa-solid fa-campground"></i> Troupe</button>
        <button class="pub-tab" data-gfilter="Grappe"><i class="fa-solid fa-leaf"></i> Grappe</button>
        <button class="pub-tab" data-gfilter="Route"><i class="fa-solid fa-map"></i> Route</button>
        <button class="pub-tab" data-gfilter="Amical"><i class="fa-solid fa-handshake"></i> Amical</button>
      </div>
      @if(auth()->check() && auth()->user()->isSuperAdmin())
      <button class="btn-primary btn-sm" id="btnAddMedia"><i class="fa-solid fa-upload"></i> Ajouter média</button>
      @endif
    </div>
    <input type="file" id="fileInput" multiple accept="image/*,video/*">
    @if(auth()->check() && auth()->user()->isSuperAdmin())
    <div class="upload-zone" id="uploadZone">
      <span class="upload-icon"><i class="fa-solid fa-folder-open"></i></span>
      <div style="font-weight:700;margin-bottom:.3rem">Cliquez ou glissez vos fichiers ici</div>
      <small>Images (JPG, PNG, GIF, WEBP) et Vidéos (MP4, MOV) — max 50MB par fichier</small>
    </div>
    @endif
    <div class="galerie-grid" id="galerieGrid" style="margin-top:1.5rem"></div>
    <div id="galerieEmpty" class="empty-state" style="display:none">
      <span class="empty-icon"><i class="fa-solid fa-images"></i></span><p>Aucun média dans cette catégorie.<br>Ajoutez vos premières photos ou vidéos !</p>
    </div>
  </div></section>
</div>

<!-- ===== PAGE MEMBRES ===== -->
<div class="page" id="page-membres" style="padding-top:68px;min-height:100vh;background:var(--gris-clair);">
  <div class="page-hero">
    <div class="section-title" style="color:#fff">Gestion des <span>Membres</span></div>
    <div class="section-bar"></div>
    <p>Gérez les inscriptions, suivez les statuts et consultez les fiches de tous les membres.</p>
  </div>
  <section><div class="container">
    <div class="membres-toolbar">
      <div style="display:flex;gap:.5rem;flex-wrap:wrap;" id="membreFilterBtns">
        <button class="pub-tab active" data-mfilter="tous">Tous</button>
        <button class="pub-tab" data-mfilter="Meute"><i class="fa-solid fa-paw"></i> Meute</button>
        <button class="pub-tab" data-mfilter="Troupe"><i class="fa-solid fa-campground"></i> Troupe</button>
        <button class="pub-tab" data-mfilter="Grappe"><i class="fa-solid fa-leaf"></i> Grappe</button>
        <button class="pub-tab" data-mfilter="Route"><i class="fa-solid fa-map"></i> Route</button>
        <button class="pub-tab" data-mfilter="Amical"><i class="fa-solid fa-handshake"></i> Amical</button>
        <button class="pub-tab" data-mfilter="actif"><i class="fa-solid fa-circle-check"></i> Actifs</button>
        <button class="pub-tab" data-mfilter="attente"><i class="fa-solid fa-hourglass-half"></i> En attente</button>
      </div>
      <input type="text" class="pub-search" id="membreSearch" placeholder="Rechercher un membre...">
    </div>
    <div id="membres-stats" style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem;"></div>
    <div class="membres-grid" id="membresGrid"></div>
    <div id="membresEmpty" class="empty-state" style="display:none">
      <span class="empty-icon"><i class="fa-solid fa-users"></i></span><p>Aucun membre trouvé.</p>
      <button class="btn-primary btn-sm" style="margin-top:1rem" data-nav="inscription"><i class="fa-solid fa-plus"></i> Ajouter un membre</button>
    </div>
  </div></section>
</div>

<!-- ===== PAGE INSCRIPTION ===== -->
<div class="page" id="page-inscription" style="padding-top:68px;min-height:100vh;background:var(--gris-clair);">
  <div class="page-hero">
    <div class="section-title" style="color:#fff">Inscription <span>des Membres</span></div>
    <div class="section-bar"></div>
    <p>Rejoignez la grande famille du Groupe Scout Saint Nicolas.</p>
  </div>
  <section><div class="container">
    <div class="form-card">
      <div class="form-header"><h3><i class="fa-solid fa-fleur-de-lis"></i> Formulaire d'Inscription</h3><p>Remplissez les informations ci-dessous pour rejoindre notre groupe</p></div>
      <div class="form-body">
        <div class="form-grid">
          <div class="form-group"><label>Prénom *</label><input type="text" id="f-prenom" placeholder="Jean"></div>
          <div class="form-group"><label>Nom *</label><input type="text" id="f-nom" placeholder="Dupont"></div>
          <div class="form-group"><label>Date de naissance *</label><input type="date" id="f-dob"></div>
          <div class="form-group"><label>Genre</label><select id="f-genre"><option value="">Sélectionner...</option><option>Masculin</option><option>Féminin</option><option>Autre</option></select></div>
          <div class="form-group"><label>Email</label><input type="email" id="f-email" placeholder="jean@exemple.com"></div>
          <div class="form-group"><label id="lbl-tel">Téléphone</label><input type="tel" id="f-tel" placeholder="+257 XX XXX XXX"></div>
          <div class="form-group full"><label>Adresse</label><input type="text" id="f-adresse" placeholder="Quartier, Ville"></div>
          <div class="form-group full"><label>Choisir votre Unité *</label>
            <div class="unite-selector">
              <input type="radio" name="unite" id="u-meute" value="Meute" class="unite-opt"><label for="u-meute" class="unite-opt-label"><span><i class="fa-solid fa-paw"></i></span>Meute<small style="font-weight:400;color:#888">6-11 ans</small></label>
              <input type="radio" name="unite" id="u-troupe" value="Troupe" class="unite-opt"><label for="u-troupe" class="unite-opt-label"><span><i class="fa-solid fa-campground"></i></span>Troupe<small style="font-weight:400;color:#888">12-17 ans</small></label>
              <input type="radio" name="unite" id="u-grappe" value="Grappe" class="unite-opt"><label for="u-grappe" class="unite-opt-label"><span><i class="fa-solid fa-leaf"></i></span>Grappe<small style="font-weight:400;color:#888">17-20 ans</small></label>
              <input type="radio" name="unite" id="u-route" value="Route" class="unite-opt"><label for="u-route" class="unite-opt-label"><span><i class="fa-solid fa-map"></i></span>Route<small style="font-weight:400;color:#888">20-23 ans</small></label>
              <input type="radio" name="unite" id="u-amical" value="Amical" class="unite-opt"><label for="u-amical" class="unite-opt-label"><span><i class="fa-solid fa-handshake"></i></span>Amical<small style="font-weight:400;color:#888">23 ans+</small></label>
            </div>
          </div>
          <div class="form-group full"><label>Parent/Tuteur (si mineur)</label><input type="text" id="f-parent" placeholder="Nom complet · Téléphone"></div>
          <div class="form-group full"><label>Informations médicales</label><textarea id="f-medical" placeholder="Allergies, conditions particulières..."></textarea></div>
          <div class="form-group full"><label>Motivation</label><textarea id="f-motivation" placeholder="Pourquoi souhaitez-vous rejoindre le Groupe Scout Saint Nicolas ?"></textarea></div>
        </div>
        <button class="form-submit" id="btnSubmitInscription"><i class="fa-solid fa-fleur-de-lis"></i> Soumettre mon inscription</button>
      </div>
    </div>
  </div></section>
</div>

<!-- MODAL PUBLICATION -->
<div class="modal-overlay" id="modalPub">
  <div class="modal">
    <button class="modal-close" data-close="modalPub"><i class="fa-solid fa-xmark"></i></button>
    <h2 id="modalPubTitle"><i class="fa-solid fa-file-pen"></i> Nouvelle Publication</h2>
    <input type="hidden" id="pubEditId">
    <div class="modal-grid">
      <div class="form-group full"><label>Titre *</label><input type="text" id="pub-titre" placeholder="Ex: Règlement intérieur 2025"></div>
      <div class="form-group"><label>Type *</label><select id="pub-type"><option value="">Choisir...</option><option value="statut">Statut</option><option value="reglement">Règlement</option><option value="article">Article</option><option value="annonce">Annonce</option></select></div>
      <div class="form-group"><label>Unité concernée</label><select id="pub-unite"><option value="Tous">Tous</option><option value="Meute">Meute</option><option value="Troupe">Troupe</option><option value="Grappe">Grappe</option><option value="Route">Route</option><option value="Amical">Amical</option></select></div>
      <div class="form-group"><label>Auteur *</label><input type="text" id="pub-auteur" placeholder="Nom de l'auteur"></div>
      <div class="form-group"><label>Date</label><input type="date" id="pub-date"></div>
      <div class="form-group full"><label>Contenu / Description</label><textarea id="pub-contenu" placeholder="Résumé ou contenu..."></textarea></div>
      <div class="form-group full">
        <label><i class="fa-solid fa-paperclip"></i> Fichiers joints</label>
        <div class="pub-upload-zone" id="pubUploadZone">
          <input type="file" id="pubFileInput" multiple style="display:none">
          <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.8rem;color:var(--bleu-clair);margin-bottom:.4rem;display:block;"></i>
          <div style="font-weight:600;font-size:.85rem;">Cliquez ou glissez vos fichiers ici</div>
          <div style="font-size:.75rem;color:var(--gris);margin-top:.2rem;">PDF, Word, Excel, images (max 5 Mo par fichier)</div>
        </div>
        <div id="pubFileList" class="pub-file-list"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-danger" data-close="modalPub">Annuler</button>
      <button class="btn-bleu" id="btnSavePub"><i class="fa-solid fa-check"></i> Enregistrer</button>
    </div>
  </div>
</div>
<!-- MODAL VOIR PUBLICATION -->
<div class="modal-overlay" id="modalPubView">
  <div class="modal">
    <button class="modal-close" data-close="modalPubView"><i class="fa-solid fa-xmark"></i></button>
    <div id="pubViewContent"></div>
    <div class="modal-footer"><button class="btn-bleu" data-close="modalPubView">Fermer</button></div>
  </div>
</div>
<!-- MODAL GALERIE -->
<div class="modal-overlay" id="modalGalerie">
  <div class="modal">
    <button class="modal-close" data-close="modalGalerie"><i class="fa-solid fa-xmark"></i></button>
    <h2><i class="fa-solid fa-images"></i> Informations du média</h2>
    <input type="hidden" id="galerieEditId">
    <div class="modal-grid">
      <div class="form-group full"><label>Titre / Légende</label><input type="text" id="gal-titre" placeholder="Ex: Camp d'été 2025"></div>
      <div class="form-group"><label>Unité</label><select id="gal-unite"><option value="Tous">Tous</option><option value="Meute">Meute</option><option value="Troupe">Troupe</option><option value="Grappe">Grappe</option><option value="Route">Route</option><option value="Amical">Amical</option></select></div>
      <div class="form-group"><label>Date</label><input type="date" id="gal-date"></div>
    </div>
    <div class="modal-footer">
      <button class="btn-danger" data-close="modalGalerie">Annuler</button>
      <button class="btn-bleu" id="btnSaveGalerie"><i class="fa-solid fa-check"></i> Enregistrer</button>
    </div>
  </div>
</div>
<!-- MODAL MEMBRE -->
<div class="modal-overlay" id="modalMembre">
  <div class="modal">
    <button class="modal-close" data-close="modalMembre"><i class="fa-solid fa-xmark"></i></button>
    <div id="membreViewContent"></div>
    <div class="modal-footer" id="membreViewActions"></div>
  </div>
</div>
<!-- CONFIRM -->
<div class="modal-overlay" id="modalConfirm">
  <div class="modal" style="max-width:420px">
    <button class="modal-close" data-close="modalConfirm"><i class="fa-solid fa-xmark"></i></button>
    <h2 id="confirmTitle"><i class="fa-solid fa-triangle-exclamation"></i> Confirmation</h2>
    <p id="confirmMsg" style="color:var(--gris);line-height:1.6;margin-top:-.5rem"></p>
    <div style="display:flex;gap:.8rem;justify-content:flex-end;margin-top:1.5rem">
      <button class="btn-bleu" data-close="modalConfirm">Annuler</button>
      <button class="btn-danger" id="confirmOkBtn">Confirmer</button>
    </div>
  </div>
</div>
<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
  <button class="lightbox-close" id="lightboxClose"><i class="fa-solid fa-xmark"></i></button>
  <div id="lightboxContent"></div>
  <div class="lightbox-info" id="lightboxInfo"></div>
</div>
<div class="toast" id="toast"></div>

<script>
(function(){
'use strict';
var isSuperAdmin={{ auth()->check() && auth()->user()->isSuperAdmin() ? 'true' : 'false' }};
var STORE={get:function(k){try{return JSON.parse(localStorage.getItem('gsn_'+k)||'null');}catch(e){return null;}},set:function(k,v){try{localStorage.setItem('gsn_'+k,JSON.stringify(v));}catch(e){}}};
var publications=STORE.get('pubs')||[
  {id:1,titre:"Statuts du Groupe Scout Saint Nicolas",type:"statut",unite:"Tous",date:"2025-01-15",auteur:"Chef de Groupe",contenu:"Statuts officiels régissant le fonctionnement du Groupe Scout Saint Nicolas."},
  {id:2,titre:"Règlement intérieur 2025",type:"reglement",unite:"Tous",date:"2025-01-20",auteur:"Conseil de Groupe",contenu:"Règles de vie et de conduite au sein du groupe."},
  {id:3,titre:"Code de conduite – Unité Meute",type:"reglement",unite:"Meute",date:"2025-02-01",auteur:"Akela",contenu:"Code de conduite spécifique aux louvetaux."},
  {id:4,titre:"Retour d'expérience – Camp d'été 2024",type:"article",unite:"Troupe",date:"2024-09-10",auteur:"Jean B.",contenu:"Compte-rendu du camp d'été 2024 de la Troupe."},
  {id:5,titre:"Réunion mensuelle – Mars 2025",type:"annonce",unite:"Tous",date:"2025-02-28",auteur:"Chef de Groupe",contenu:"Annonce de la réunion mensuelle de mars 2025."},
  {id:6,titre:"Charte de la Grappe",type:"statut",unite:"Grappe",date:"2025-01-10",auteur:"Président Grappe",contenu:"Charte définissant les engagements des membres de la Grappe."},
  {id:7,titre:"Calendrier des activités 2025",type:"article",unite:"Tous",date:"2025-01-05",auteur:"Secrétariat",contenu:"Planning complet des activités prévues pour l'année 2025."}
];
var membres=STORE.get('membres')||[];
var galerie=STORE.get('galerie')||[];
var pubFilter='tous',membreFilter='tous',galerieFilter='tous';
var pendingFile=null;
var nextPubId=publications.reduce(function(m,p){return Math.max(m,p.id);},0)+1;
var typeLabel={statut:'<i class="fa-solid fa-scroll"></i> Statut',reglement:'<i class="fa-solid fa-scale-balanced"></i> Règlement',article:'<i class="fa-solid fa-newspaper"></i> Article',annonce:'<i class="fa-solid fa-bullhorn"></i> Annonce'};
var typeClass={statut:'b-statut',reglement:'b-reglement',article:'b-article',annonce:'b-annonce'};
var uniteColors={Meute:'#F5C400',Troupe:'#2A8C4A',Grappe:'#1B4F9B',Route:'#C0392B',Amical:'#555',Tous:'#888'};
var uniteIcons={Meute:'<i class="fa-solid fa-paw"></i>',Troupe:'<i class="fa-solid fa-campground"></i>',Grappe:'<i class="fa-solid fa-leaf"></i>',Route:'<i class="fa-solid fa-map"></i>',Amical:'<i class="fa-solid fa-handshake"></i>',Tous:'<i class="fa-solid fa-globe"></i>'};
var avatarColors=['#1B4F9B','#2A8C4A','#C0392B','#e67e22','#8e44ad','#16a085','#2980b9','#d35400'];
function savePubs(){STORE.set('pubs',publications);updateStats();}
function saveMembres(){STORE.set('membres',membres);updateStats();}
function saveGalerie(){try{STORE.set('galerie',galerie);}catch(e){}updateStats();}
function formatDate(d){if(!d)return'—';var p=d.split('-');var m=['jan','fév','mar','avr','mai','jun','jul','aoû','sep','oct','nov','déc'];return p[2]+' '+m[parseInt(p[1])-1]+' '+p[0];}
function escHtml(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
function avatarColor(s){var h=0;for(var i=0;i<s.length;i++)h=(h*31+s.charCodeAt(i))&0xffff;return avatarColors[h%avatarColors.length];}
function getInitials(p,n){return((p||'?')[0]+(n||'?')[0]).toUpperCase();}
var toastTimer;
function showToast(msg,type){var t=document.getElementById('toast');t.innerHTML=msg;t.className='toast show '+(type||'');clearTimeout(toastTimer);toastTimer=setTimeout(function(){t.classList.remove('show');},3500);}
function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}
function showConfirm(title,msg,onOk){document.getElementById('confirmTitle').innerHTML=title;document.getElementById('confirmMsg').textContent=msg;document.getElementById('confirmOkBtn').onclick=function(){onOk();closeModal('modalConfirm');};openModal('modalConfirm');}
function updateStats(){
  var actifs=membres.filter(function(m){return m.statut==='actif';}).length;
  document.getElementById('stat-membres').textContent=actifs;
  document.getElementById('stat-pubs').textContent=publications.length;
  document.getElementById('stat-photos').textContent=galerie.length;
  ['Meute','Troupe','Grappe','Route','Amical'].forEach(function(u){
    var el=document.getElementById('stat-'+u.toLowerCase()+'-membres');
    if(el){var tot=membres.filter(function(m){return m.unite===u;}).length;var act=membres.filter(function(m){return m.unite===u&&m.statut==='actif';}).length;el.textContent=tot?tot+' membre'+(tot>1?'s':'')+' ('+act+' actif'+(act>1?'s':'')+')'  :'Aucun membre inscrit';}
  });
}
function showPage(page){
  document.querySelectorAll('.page').forEach(function(p){p.classList.remove('active');});
  var t=document.getElementById('page-'+page);if(t)t.classList.add('active');
  window.scrollTo({top:0,behavior:'smooth'});
  if(page==='publications')renderPubs();
  if(page==='galerie')renderGalerie();
  if(page==='membres')renderMembres();
  if(page==='unites')updateStats();
  closeMenu();
}
function toggleMenu(){document.getElementById('hamburger').classList.toggle('open');document.getElementById('mobileMenu').classList.toggle('open');}
function closeMenu(){document.getElementById('hamburger').classList.remove('open');document.getElementById('mobileMenu').classList.remove('open');}
/* PUBLICATIONS */
function renderPubs(){
  var search=(document.getElementById('pubSearch').value||'').toLowerCase();
  var list=publications.filter(function(p){if(pubFilter!=='tous'&&p.type!==pubFilter)return false;if(search&&!p.titre.toLowerCase().includes(search)&&!(p.auteur||'').toLowerCase().includes(search))return false;return true;});
  var tbody=document.getElementById('pub-tbody');
  if(list.length===0){tbody.innerHTML='<tr><td colspan="7"><div class="empty-state"><span class="empty-icon"><i class="fa-regular fa-file"></i></span><p>Aucune publication trouvée.</p></div></td></tr>';}
  else{tbody.innerHTML=list.map(function(p){var prev=(p.contenu||'').substring(0,60)+(p.contenu&&p.contenu.length>60?'...':'');var fc=p.fichiers&&p.fichiers.length?'<span style="display:inline-flex;align-items:center;gap:3px;font-size:.73rem;color:var(--bleu);margin-left:6px;font-weight:600"><i class="fa-solid fa-paperclip"></i>'+p.fichiers.length+'</span>':'';return'<tr><td><strong style="color:var(--bleu-fonce)">#'+p.id+'</strong></td><td><strong>'+escHtml(p.titre)+'</strong>'+fc+(prev?'<br><small style="color:var(--gris);font-weight:400">'+escHtml(prev)+'</small>':'')+'</td><td><span class="badge '+(typeClass[p.type]||'b-article')+'">'+(typeLabel[p.type]||p.type)+'</span></td><td><span style="display:inline-flex;align-items:center;gap:6px;font-size:.85rem;font-weight:600"><span style="width:10px;height:10px;border-radius:50%;background:'+(uniteColors[p.unite]||'#888')+';display:inline-block"></span>'+escHtml(p.unite)+'</span></td><td style="color:var(--gris);font-size:.85rem;white-space:nowrap">'+formatDate(p.date)+'</td><td style="font-size:.85rem">'+escHtml(p.auteur)+'</td><td style="white-space:nowrap"><button data-action="view-pub" data-id="'+p.id+'" style="background:none;border:none;cursor:pointer;font-size:1.1rem;padding:3px"><i class="fa-solid fa-eye"></i></button><button data-action="edit-pub" data-id="'+p.id+'" style="background:none;border:none;cursor:pointer;font-size:1.1rem;padding:3px"><i class="fa-solid fa-pen"></i></button><button data-action="del-pub" data-id="'+p.id+'" style="background:none;border:none;cursor:pointer;font-size:1.1rem;padding:3px"><i class="fa-solid fa-trash"></i></button></td></tr>';}).join('');}
  document.getElementById('pub-count').textContent=list.length+' publication'+(list.length>1?'s':'')+' affichée'+(list.length>1?'s':'');
}
var pubFiles=[];
var pubFileIcons={'pdf':'fa-solid fa-file-pdf','doc':'fa-solid fa-file-word','docx':'fa-solid fa-file-word','xls':'fa-solid fa-file-excel','xlsx':'fa-solid fa-file-excel','ppt':'fa-solid fa-file-powerpoint','pptx':'fa-solid fa-file-powerpoint','jpg':'fa-solid fa-file-image','jpeg':'fa-solid fa-file-image','png':'fa-solid fa-file-image','gif':'fa-solid fa-file-image','webp':'fa-solid fa-file-image','txt':'fa-solid fa-file-lines','csv':'fa-solid fa-file-csv'};
function getFileIcon(name){var ext=(name.split('.').pop()||'').toLowerCase();return pubFileIcons[ext]||'fa-solid fa-file';}
function formatFileSize(bytes){if(bytes<1024)return bytes+' o';if(bytes<1048576)return(bytes/1024).toFixed(1)+' Ko';return(bytes/1048576).toFixed(1)+' Mo';}
function renderPubFiles(){var list=document.getElementById('pubFileList');list.innerHTML=pubFiles.map(function(f,i){return'<div class="pub-file-item"><i class="file-icon '+getFileIcon(f.name)+'"></i><span class="file-name" title="'+escHtml(f.name)+'">'+escHtml(f.name)+'</span><span class="file-size">'+formatFileSize(f.size)+'</span><button type="button" class="file-remove" data-idx="'+i+'" title="Retirer"><i class="fa-solid fa-xmark"></i></button></div>';}).join('');}
function addPubFiles(files){for(var i=0;i<files.length;i++){var f=files[i];if(f.size>5*1048576){showToast('<i class="fa-solid fa-triangle-exclamation"></i> "'+f.name+'" dépasse 5 Mo','warning');continue;}(function(file){var reader=new FileReader();reader.onload=function(e){pubFiles.push({name:file.name,size:file.size,data:e.target.result});renderPubFiles();};reader.readAsDataURL(file);})(f);}}
function openPubModal(editId){var p=editId?publications.find(function(x){return x.id==editId;}):null;document.getElementById('modalPubTitle').innerHTML=p?'<i class="fa-solid fa-pen"></i> Modifier':'<i class="fa-solid fa-file-pen"></i> Nouvelle Publication';document.getElementById('pubEditId').value=p?p.id:'';document.getElementById('pub-titre').value=p?p.titre:'';document.getElementById('pub-type').value=p?p.type:'';document.getElementById('pub-unite').value=p?p.unite:'Tous';document.getElementById('pub-auteur').value=p?p.auteur:'';document.getElementById('pub-date').value=p?p.date:new Date().toISOString().split('T')[0];document.getElementById('pub-contenu').value=p?(p.contenu||''):'';pubFiles=p&&p.fichiers?p.fichiers.slice():[];renderPubFiles();openModal('modalPub');}
function savePub(){var titre=document.getElementById('pub-titre').value.trim();var type=document.getElementById('pub-type').value;var auteur=document.getElementById('pub-auteur').value.trim();if(!titre||!type||!auteur){showToast('<i class="fa-solid fa-triangle-exclamation"></i> Remplissez les champs obligatoires (*)','warning');return;}var editId=document.getElementById('pubEditId').value;var obj={titre:titre,type:type,unite:document.getElementById('pub-unite').value,auteur:auteur,date:document.getElementById('pub-date').value,contenu:document.getElementById('pub-contenu').value,fichiers:pubFiles.slice()};if(editId){var idx=publications.findIndex(function(p){return p.id==editId;});publications[idx]=Object.assign({},publications[idx],obj);showToast('<i class="fa-solid fa-circle-check"></i> Publication modifiée !','success');}else{obj.id=nextPubId++;publications.unshift(obj);showToast('<i class="fa-solid fa-circle-check"></i> Publication ajoutée !','success');}savePubs();renderPubs();closeModal('modalPub');}
function viewPub(id){var p=publications.find(function(x){return x.id==id;});if(!p)return;var filesHtml='';if(p.fichiers&&p.fichiers.length>0){filesHtml='<div style="margin-top:1.2rem"><div style="font-weight:700;font-size:.85rem;margin-bottom:.5rem;color:var(--bleu-fonce)"><i class="fa-solid fa-paperclip"></i> Fichiers joints ('+p.fichiers.length+')</div>';filesHtml+=p.fichiers.map(function(f){return'<a href="'+f.data+'" download="'+escHtml(f.name)+'" style="display:flex;align-items:center;gap:.6rem;padding:.5rem .7rem;background:var(--gris-clair);border-radius:8px;margin-bottom:.35rem;text-decoration:none;color:var(--bleu-fonce);font-size:.83rem;transition:background .15s;" onmouseover="this.style.background=\'#dce6f5\'" onmouseout="this.style.background=\'\'"><i class="'+getFileIcon(f.name)+'" style="font-size:1.1rem;color:var(--bleu)"></i><span style="flex:1;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">'+escHtml(f.name)+'</span><span style="color:var(--gris);font-size:.75rem">'+formatFileSize(f.size)+'</span><i class="fa-solid fa-download" style="color:var(--bleu-clair)"></i></a>';}).join('')+'</div>';}document.getElementById('pubViewContent').innerHTML='<h2>'+escHtml(p.titre)+'</h2><div style="display:flex;gap:.8rem;flex-wrap:wrap;margin:1rem 0 1.5rem;align-items:center"><span class="badge '+(typeClass[p.type]||'b-article')+'">'+(typeLabel[p.type]||p.type)+'</span><span style="font-size:.85rem;color:var(--gris);display:inline-flex;align-items:center;gap:5px"><span style="width:10px;height:10px;border-radius:50%;background:'+(uniteColors[p.unite]||'#888')+';display:inline-block"></span>'+escHtml(p.unite)+'</span><span style="font-size:.85rem;color:var(--gris)"><i class="fa-solid fa-calendar-days"></i> '+formatDate(p.date)+'</span><span style="font-size:.85rem;color:var(--gris)"><i class="fa-solid fa-pen-nib"></i> '+escHtml(p.auteur)+'</span></div><div style="background:var(--gris-clair);border-radius:12px;padding:1.2rem;line-height:1.7;font-size:.93rem">'+(p.contenu?escHtml(p.contenu):'<em style="color:var(--gris)">Aucun contenu.</em>')+'</div>'+filesHtml;openModal('modalPubView');}
function deletePub(id){var p=publications.find(function(x){return x.id==id;});if(!p)return;showConfirm('<i class="fa-solid fa-trash"></i> Supprimer','Voulez-vous vraiment supprimer "'+p.titre+'" ?',function(){publications=publications.filter(function(x){return x.id!==id;});savePubs();renderPubs();showToast('<i class="fa-solid fa-trash"></i> Publication supprimée','error');});}
/* GALERIE */
function renderGalerie(){var grid=document.getElementById('galerieGrid');var empty=document.getElementById('galerieEmpty');var list=galerie.filter(function(g){if(galerieFilter==='tous')return true;if(galerieFilter==='photo')return g.type==='photo';if(galerieFilter==='video')return g.type==='video';return g.unite===galerieFilter;});if(list.length===0){grid.innerHTML='';empty.style.display='block';return;}empty.style.display='none';grid.innerHTML=list.map(function(g){var media=g.type==='video'?'<video src="'+g.data+'" muted playsinline style="width:100%;height:100%;object-fit:cover"></video>':'<img src="'+g.data+'" alt="'+escHtml(g.titre)+'" loading="lazy">';return'<div class="galerie-item">'+media+'<div class="galerie-overlay"><span>'+escHtml(g.titre||'Sans titre')+'</span><span style="font-size:.75rem;opacity:.8">'+escHtml(g.unite)+(g.date?' · '+formatDate(g.date):'')+'</span><div style="display:flex;gap:.5rem;margin-top:.5rem"><button data-action="view-gal" data-id="'+g.id+'" style="background:rgba(255,255,255,.2);border:none;color:#fff;border-radius:6px;padding:.3rem .7rem;font-size:.75rem;cursor:pointer"><i class="fa-solid fa-magnifying-glass"></i> Voir</button>'+(isSuperAdmin?'<button data-action="del-gal" data-id="'+g.id+'" class="galerie-del-btn"><i class="fa-solid fa-trash"></i></button>':'')+'</div></div></div>';}).join('');}
function handleFiles(files){if(!files||!files.length)return;var file=files[0];if(file.size>52428800){showToast('<i class="fa-solid fa-triangle-exclamation"></i> Fichier trop grand (max 50MB)','warning');return;}var reader=new FileReader();reader.onload=function(e){pendingFile={data:e.target.result,type:file.type.startsWith('video')?'video':'photo',name:file.name};document.getElementById('gal-titre').value=file.name.replace(/\.[^.]+$/,'');document.getElementById('gal-date').value=new Date().toISOString().split('T')[0];document.getElementById('gal-unite').value='Tous';document.getElementById('galerieEditId').value='';openModal('modalGalerie');};reader.readAsDataURL(file);document.getElementById('fileInput').value='';}
function saveGalerieItem(){if(!pendingFile&&!document.getElementById('galerieEditId').value){closeModal('modalGalerie');return;}var editId=document.getElementById('galerieEditId').value;if(editId){var idx=galerie.findIndex(function(g){return g.id==editId;});if(idx>-1){galerie[idx].titre=document.getElementById('gal-titre').value||galerie[idx].titre;galerie[idx].unite=document.getElementById('gal-unite').value;galerie[idx].date=document.getElementById('gal-date').value;}showToast('<i class="fa-solid fa-circle-check"></i> Média modifié !','success');}else{var item={id:Date.now(),data:pendingFile.data,type:pendingFile.type,titre:document.getElementById('gal-titre').value||pendingFile.name,unite:document.getElementById('gal-unite').value,date:document.getElementById('gal-date').value};galerie.unshift(item);showToast('<i class="fa-solid fa-circle-check"></i> Média ajouté !','success');}try{saveGalerie();}catch(e){showToast('<i class="fa-solid fa-triangle-exclamation"></i> Stockage limité','warning');}pendingFile=null;closeModal('modalGalerie');renderGalerie();}
function openLightbox(id){var g=galerie.find(function(x){return x.id==id;});if(!g)return;document.getElementById('lightboxContent').innerHTML=g.type==='video'?'<video src="'+g.data+'" controls autoplay style="max-width:90vw;max-height:80vh;border-radius:10px"></video>':'<img src="'+g.data+'" alt="'+escHtml(g.titre)+'" style="max-width:90vw;max-height:80vh;border-radius:10px;object-fit:contain">';document.getElementById('lightboxInfo').textContent=(g.titre||'')+(g.unite?' · '+g.unite:'')+(g.date?' · '+formatDate(g.date):'');document.getElementById('lightbox').classList.add('open');}
function deleteGalerie(id){var g=galerie.find(function(x){return x.id==id;});if(!g)return;showConfirm('<i class="fa-solid fa-trash"></i> Supprimer le média','Supprimer "'+((g.titre)||'ce média')+'" ?',function(){galerie=galerie.filter(function(x){return x.id!==id;});saveGalerie();renderGalerie();showToast('<i class="fa-solid fa-trash"></i> Média supprimé','error');});}
/* MEMBRES */
function renderMembres(){
  var search=(document.getElementById('membreSearch').value||'').toLowerCase();
  var list=membres.filter(function(m){if(membreFilter==='actif'){if(m.statut!=='actif')return false;}else if(membreFilter==='attente'){if(m.statut!=='attente')return false;}else if(membreFilter!=='tous'){if(m.unite!==membreFilter)return false;}if(search){var full=((m.prenom||'')+' '+(m.nom||'')).toLowerCase();if(!full.includes(search)&&!(m.tel||'').includes(search)&&!(m.email||'').toLowerCase().includes(search))return false;}return true;});
  var stats={actif:0,attente:0,inactif:0};membres.forEach(function(m){stats[m.statut]=(stats[m.statut]||0)+1;});
  document.getElementById('membres-stats').innerHTML='<div style="background:#eafaf1;border-radius:10px;padding:.6rem 1.2rem;font-size:.85rem;font-weight:700;color:var(--vert)"><i class="fa-solid fa-circle-check"></i> Actifs: '+(stats.actif||0)+'</div><div style="background:#fdf3e8;border-radius:10px;padding:.6rem 1.2rem;font-size:.85rem;font-weight:700;color:#e67e22"><i class="fa-solid fa-hourglass-half"></i> En attente: '+(stats.attente||0)+'</div><div style="background:#f5f5f5;border-radius:10px;padding:.6rem 1.2rem;font-size:.85rem;font-weight:700;color:#888"><i class="fa-regular fa-circle"></i> Inactifs: '+(stats.inactif||0)+'</div><div style="background:#eaf1fb;border-radius:10px;padding:.6rem 1.2rem;font-size:.85rem;font-weight:700;color:var(--bleu)"><i class="fa-solid fa-users"></i> Total: '+membres.length+'</div>';
  var grid=document.getElementById('membresGrid');var empty=document.getElementById('membresEmpty');
  if(list.length===0){grid.innerHTML='';empty.style.display='block';return;}empty.style.display='none';
  grid.innerHTML=list.map(function(m){var sc=m.statut==='actif'?'statut-actif':m.statut==='attente'?'statut-attente':'statut-inactif';var sl=m.statut==='actif'?'<i class="fa-solid fa-circle-check"></i> Actif':m.statut==='attente'?'<i class="fa-solid fa-hourglass-half"></i> En attente':'<i class="fa-regular fa-circle"></i> Inactif';return'<div class="membre-card"><div class="membre-header"><div class="membre-avatar" style="background:'+avatarColor((m.nom||'')+(m.prenom||''))+'">'+getInitials(m.prenom,m.nom)+'</div><div class="membre-info"><h4>'+escHtml(m.prenom)+' '+escHtml(m.nom)+'</h4><p>'+escHtml(m.unite)+' '+(uniteIcons[m.unite]||'')+'</p></div></div><div class="membre-details">'+(m.tel?'<span><i class="fa-solid fa-phone"></i> '+escHtml(m.tel)+'</span>':'')+(m.email?'<span><i class="fa-solid fa-envelope"></i> '+escHtml(m.email)+'</span>':'')+(m.dob?'<span><i class="fa-solid fa-cake-candles"></i> '+formatDate(m.dob)+'</span>':'')+(m.adresse?'<span><i class="fa-solid fa-location-dot"></i> '+escHtml(m.adresse)+'</span>':'')+'</div><div style="margin-top:.7rem"><span class="statut-badge '+sc+'">'+sl+'</span></div><div class="membre-actions"><button class="btn-bleu" style="font-size:.78rem;padding:.4rem .8rem" data-action="view-membre" data-id="'+m.id+'"><i class="fa-solid fa-eye"></i> Voir</button>'+(isSuperAdmin&&m.statut==='attente'?'<button class="btn-primary btn-sm" style="font-size:.78rem;padding:.4rem .8rem" data-action="activer-membre" data-id="'+m.id+'"><i class="fa-solid fa-circle-check"></i> Valider</button>':'')+(isSuperAdmin?'<button class="btn-danger" style="font-size:.78rem;padding:.4rem .8rem;margin-left:auto" data-action="del-membre" data-id="'+m.id+'"><i class="fa-solid fa-trash"></i></button>':'')+'</div></div>';}).join('');
}
function viewMembre(id){var m=membres.find(function(x){return x.id==id;});if(!m)return;var sc=m.statut==='actif'?'statut-actif':m.statut==='attente'?'statut-attente':'statut-inactif';var sl=m.statut==='actif'?'<i class="fa-solid fa-circle-check"></i> Actif':m.statut==='attente'?'<i class="fa-solid fa-hourglass-half"></i> En attente':'<i class="fa-regular fa-circle"></i> Inactif';document.getElementById('membreViewContent').innerHTML='<div style="text-align:center;margin-bottom:1.5rem"><div style="width:80px;height:80px;border-radius:50%;background:'+avatarColor((m.nom||'')+(m.prenom||''))+';display:inline-flex;align-items:center;justify-content:center;font-size:2rem;font-weight:900;color:#fff;margin-bottom:.8rem">'+getInitials(m.prenom,m.nom)+'</div><h2 style="margin-bottom:.3rem;font-family:Cinzel,serif">'+escHtml(m.prenom)+' '+escHtml(m.nom)+'</h2><span class="statut-badge '+sc+'">'+sl+'</span></div><div style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem;font-size:.88rem"><div><strong>Unité</strong><br>'+escHtml(m.unite)+' '+(uniteIcons[m.unite]||'')+'</div><div><strong>Naissance</strong><br>'+formatDate(m.dob)+'</div><div><strong>Genre</strong><br>'+escHtml(m.genre||'—')+'</div><div><strong>Téléphone</strong><br>'+escHtml(m.tel||'—')+'</div><div><strong>Email</strong><br>'+escHtml(m.email||'—')+'</div><div><strong>Adresse</strong><br>'+escHtml(m.adresse||'—')+'</div>'+(m.parent?'<div style="grid-column:1/-1"><strong>Parent/Tuteur</strong><br>'+escHtml(m.parent)+'</div>':'')+(m.medical&&m.medical!=='Aucune'?'<div style="grid-column:1/-1"><strong><i class="fa-solid fa-kit-medical"></i> Médical</strong><br>'+escHtml(m.medical)+'</div>':'')+(m.motivation?'<div style="grid-column:1/-1"><strong><i class="fa-solid fa-comment"></i> Motivation</strong><br><em>'+escHtml(m.motivation)+'</em></div>':'')+'</div>';document.getElementById('membreViewActions').innerHTML=isSuperAdmin?((m.statut==='attente'?'<button class="btn-primary btn-sm" data-action="activer-membre" data-id="'+m.id+'" data-close-after="modalMembre"><i class="fa-solid fa-circle-check"></i> Valider</button>':'')+(m.statut==='actif'?'<button class="btn-bleu" data-action="desactiver-membre" data-id="'+m.id+'" data-close-after="modalMembre"><i class="fa-regular fa-circle"></i> Désactiver</button>':'')+'<button class="btn-danger" data-action="del-membre" data-id="'+m.id+'" data-close-after="modalMembre"><i class="fa-solid fa-trash"></i> Supprimer</button>'):'';openModal('modalMembre');}
function activerMembre(id){var m=membres.find(function(x){return x.id==id;});if(m){m.statut='actif';saveMembres();renderMembres();showToast('<i class="fa-solid fa-circle-check"></i> '+m.prenom+' '+m.nom+' activé !','success');}}
function desactiverMembre(id){var m=membres.find(function(x){return x.id==id;});if(m){m.statut='inactif';saveMembres();renderMembres();showToast('<i class="fa-solid fa-circle-check"></i> Statut mis à jour','success');}}
function deleteMembre(id){var m=membres.find(function(x){return x.id==id;});if(!m)return;showConfirm('<i class="fa-solid fa-trash"></i> Supprimer','Supprimer "'+m.prenom+' '+m.nom+'" définitivement ?',function(){membres=membres.filter(function(x){return x.id!==id;});saveMembres();renderMembres();showToast('<i class="fa-solid fa-trash"></i> Membre supprimé','error');});}
function submitInscription(){var prenom=document.getElementById('f-prenom').value.trim();var nom=document.getElementById('f-nom').value.trim();var tel=document.getElementById('f-tel').value.trim();var dob=document.getElementById('f-dob').value;var unite=document.querySelector('input[name="unite"]:checked');var uniteVal=unite?unite.value:'';var telRequired=['Grappe','Route','Amical'].indexOf(uniteVal)!==-1;var missing=[];if(!prenom)missing.push('Prénom');if(!nom)missing.push('Nom');if(telRequired&&!tel)missing.push('Téléphone');if(!dob)missing.push('Date de naissance');if(!unite)missing.push('Unité');if(missing.length){showToast('<i class="fa-solid fa-triangle-exclamation"></i> Champs manquants : '+missing.join(', '),'warning');return;}var m={id:Date.now(),prenom:prenom,nom:nom,tel:tel,dob:dob,unite:unite.value,genre:document.getElementById('f-genre').value,email:document.getElementById('f-email').value.trim(),adresse:document.getElementById('f-adresse').value.trim(),parent:document.getElementById('f-parent').value.trim(),medical:document.getElementById('f-medical').value.trim()||'Aucune',motivation:document.getElementById('f-motivation').value.trim(),statut:'attente',dateInscription:new Date().toISOString().split('T')[0]};membres.push(m);saveMembres();showToast('<i class="fa-solid fa-champagne-glasses"></i> Inscription de '+prenom+' '+nom+' envoyée !','success');['f-prenom','f-nom','f-tel','f-email','f-adresse','f-parent','f-medical','f-motivation'].forEach(function(id){document.getElementById(id).value='';});document.getElementById('f-dob').value='';document.getElementById('f-genre').value='';var sel=document.querySelector('input[name="unite"]:checked');if(sel)sel.checked=false;setTimeout(function(){showPage('membres');},1500);}
/* EVENT DELEGATION */
document.addEventListener('click',function(e){
  var el=e.target.closest('[data-nav]');if(el){showPage(el.dataset.nav);return;}
  el=e.target.closest('[data-close]');if(el){closeModal(el.dataset.close);return;}
  el=e.target.closest('[data-filter]');if(el){pubFilter=el.dataset.filter;document.querySelectorAll('#pubFilterBtns .pub-tab').forEach(function(b){b.classList.remove('active');});el.classList.add('active');renderPubs();return;}
  el=e.target.closest('[data-gfilter]');if(el){galerieFilter=el.dataset.gfilter;document.querySelectorAll('#galerieFilterBtns .pub-tab').forEach(function(b){b.classList.remove('active');});el.classList.add('active');renderGalerie();return;}
  el=e.target.closest('[data-mfilter]');if(el){membreFilter=el.dataset.mfilter;document.querySelectorAll('#membreFilterBtns .pub-tab').forEach(function(b){b.classList.remove('active');});el.classList.add('active');renderMembres();return;}
  el=e.target.closest('[data-action]');if(el){var action=el.dataset.action;var id=Number(el.dataset.id)||el.dataset.id;var ca=el.dataset.closeAfter;if(ca)closeModal(ca);if(action==='view-pub')viewPub(id);else if(action==='edit-pub')openPubModal(id);else if(action==='del-pub')deletePub(id);else if(action==='view-gal')openLightbox(id);else if(action==='del-gal'){if(isSuperAdmin)deleteGalerie(id);}else if(action==='view-membre')viewMembre(id);else if(action==='activer-membre'){if(isSuperAdmin)activerMembre(id);}else if(action==='desactiver-membre'){if(isSuperAdmin)desactiverMembre(id);}else if(action==='del-membre'){if(isSuperAdmin)deleteMembre(id);}return;}
  if(e.target.closest('#hamburger')){toggleMenu();return;}
  if(e.target===document.getElementById('lightbox')||e.target.closest('#lightboxClose')){var v=document.querySelector('#lightboxContent video');if(v)v.pause();document.getElementById('lightbox').classList.remove('open');return;}
  var ov=e.target.closest('.modal-overlay');if(ov&&e.target===ov)ov.classList.remove('open');
});
document.getElementById('btnNewPub').addEventListener('click',function(){openPubModal();});
document.getElementById('btnSavePub').addEventListener('click',savePub);
var puz=document.getElementById('pubUploadZone');
puz.addEventListener('click',function(){document.getElementById('pubFileInput').click();});
puz.addEventListener('dragover',function(e){e.preventDefault();puz.classList.add('dragover');});
puz.addEventListener('dragleave',function(){puz.classList.remove('dragover');});
puz.addEventListener('drop',function(e){e.preventDefault();puz.classList.remove('dragover');addPubFiles(e.dataTransfer.files);});
document.getElementById('pubFileInput').addEventListener('change',function(){addPubFiles(this.files);this.value='';});
document.getElementById('pubFileList').addEventListener('click',function(e){var btn=e.target.closest('.file-remove');if(btn){pubFiles.splice(Number(btn.dataset.idx),1);renderPubFiles();}});
document.getElementById('btnSaveGalerie').addEventListener('click',saveGalerieItem);
document.getElementById('btnSubmitInscription').addEventListener('click',submitInscription);
function updateTelLabel(){var sel=document.querySelector('input[name="unite"]:checked');var lbl=document.getElementById('lbl-tel');if(!sel){lbl.textContent='Téléphone';return;}var need=['Grappe','Route','Amical'].indexOf(sel.value)!==-1;lbl.textContent=need?'Téléphone *':'Téléphone';}
document.querySelectorAll('input[name="unite"]').forEach(function(r){r.addEventListener('change',updateTelLabel);});
function getAgeFromDob(dob){var today=new Date();var birth=new Date(dob);var age=today.getFullYear()-birth.getFullYear();var m=today.getMonth()-birth.getMonth();if(m<0||(m===0&&today.getDate()<birth.getDate()))age--;return age;}
function autoSelectUnite(){var dob=document.getElementById('f-dob').value;if(!dob)return;var age=getAgeFromDob(dob);var id='';if(age>=6&&age<=11)id='u-meute';else if(age>=12&&age<=16)id='u-troupe';else if(age>=17&&age<=19)id='u-grappe';else if(age>=20&&age<=22)id='u-route';else if(age>=23)id='u-amical';if(id){document.getElementById(id).checked=true;updateTelLabel();}else{document.querySelectorAll('input[name="unite"]').forEach(function(r){r.checked=false;});updateTelLabel();if(age<6)showToast('<i class="fa-solid fa-triangle-exclamation"></i> L\'âge minimum pour s\'inscrire est de 6 ans.','warning');}}
document.getElementById('f-dob').addEventListener('change',autoSelectUnite);
var btnAddMedia=document.getElementById('btnAddMedia');
if(btnAddMedia)btnAddMedia.addEventListener('click',function(){document.getElementById('fileInput').click();});
document.getElementById('fileInput').addEventListener('change',function(){handleFiles(this.files);});
document.getElementById('pubSearch').addEventListener('input',renderPubs);
document.getElementById('membreSearch').addEventListener('input',renderMembres);
var uz=document.getElementById('uploadZone');
if(uz){uz.addEventListener('click',function(){document.getElementById('fileInput').click();});
uz.addEventListener('dragover',function(e){e.preventDefault();uz.classList.add('dragover');});
uz.addEventListener('dragleave',function(){uz.classList.remove('dragover');});
uz.addEventListener('drop',function(e){e.preventDefault();uz.classList.remove('dragover');handleFiles(e.dataTransfer.files);});}
updateStats();renderPubs();
})();
</script>
</body>
</html>