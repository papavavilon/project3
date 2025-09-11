<?php get_header(); 
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
    /* ===== SDG 2 exact look (self-contained) ===== */
    :root{
      --sdg-dark:#4b0f0f;   /* outside background */
      --sdg-card:#7c2d2d;   /* light-red card */
      --sdg-badge:#c3423a;  /* round red badges */
      --sdg-badge-b:#ffffff40;
      --sdg-beige:#fff7ef;  /* inset bg */
      --sdg-beige-b:#eadacc;/* inset border */
      --sdg-text:#ffffff;
    }

    /* Minimal reset + full-bleed */
    html,body{margin:0;padding:0;height:100%}
    *,*::before,*::after{box-sizing:border-box}

    body{
      /* modern system font stack for the same clean look */
      font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Inter,Arial,Helvetica,sans-serif;
      background:var(--sdg-dark);
      color:var(--sdg-text);
      line-height:1.66;
    }

    .sdg2-page{padding:56px 0 72px;}

    .sdg2-card{
      max-width:980px;
      margin:0 auto;
      background:var(--sdg-card);
      color:var(--sdg-text);
      border-radius:34px;
      padding:28px;
      box-shadow:0 1px 0 rgba(255,255,255,.06) inset;
      overflow:hidden; /* clip to rounded corners */
    }

    /* --- Top bar with round badges --- */
    .sdg2-topbar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      margin-bottom:12px;
    }
    .sdg2-badge{
      -webkit-appearance:none;appearance:none;
      display:inline-flex;align-items:center;justify-content:center;
      width:56px;height:56px;border-radius:50%;
      border:2px solid var(--sdg-badge-b);
      background:var(--sdg-badge);color:#fff;
      font-weight:800;font-size:22px;line-height:1;
      padding:0;cursor:pointer;
    }
    .sdg2-actions{display:inline-flex;align-items:center;gap:16px;}

    /* Language button fixed: EN centered, caret outside */
    .sdg2-lang{display:flex;align-items:center;gap:6px;}
    .sdg2-lang-btn{font-size:18px;font-weight:700;justify-content:center;}
    .sdg2-caret{
      width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-top:8px solid #fff;
    }

    /* subtitle line above hero */
    .sdg2-subtitle{
      font-size:14px;
      color:#f0dcd2;
      margin:6px 4px 10px;
    }

    /* hero image */
    .sdg2-hero{display:block;width:100%;border-radius:8px;margin:8px 0 18px;height:auto}

    /* content */
    .sdg2-title{font-size:28px;font-weight:800;letter-spacing:.2px;margin:22px 0 12px}
    .sdg2-body p{margin:0 0 18px;color:#ffe8e0}

    /* inset note (smaller than red card) */
    .sdg2-inset{
      background:var(--sdg-beige);color:#222;border:2px solid var(--sdg-beige-b);
      border-radius:12px;padding:18px 20px;margin:28px auto;box-shadow:0 2px 8px rgba(0,0,0,.08);
      max-width:610px; /* <-- makes the white box smaller */
      width:100%;
    }

    /* bottom two-column info */
    .sdg2-info{display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-top:28px}
    .sdg2-info a{color:#fff;text-decoration:underline}

    @media (max-width:900px){
      .sdg2-card{border-radius:26px;padding:22px}
      .sdg2-title{font-size:24px}
      .sdg2-info{grid-template-columns:1fr;gap:18px}
      .sdg2-badge{width:48px;height:48px;font-size:20px}
      .sdg2-lang-btn{font-size:18px}
      .sdg2-inset{max-width:100%}
    }

    /* Hide theme/page title if blocks leak in */
    .wp-site-blocks .wp-block-post-title, .entry-header, .page-title, h1.entry-title {display:none!important}
  </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
  // Resolve the current page ID safely (works outside the Loop)
  $post_id    = get_queried_object_id();
  $page_title = get_the_title( $post_id );
  $hero_url   = get_the_post_thumbnail_url( $post_id, 'full' );
?>

<main class="sdg2-page" role="main">
  <div class="sdg2-card" role="region" aria-label="SDG 2 content card">

    <!-- Top bar: round badges -->
    <div class="sdg2-topbar">
      <button class="sdg2-badge" aria-label="Close" type="button">✕</button>

      <div class="sdg2-actions">
        <button class="sdg2-badge" aria-label="Search" type="button">🔍</button>

        <!-- Language button (fixed) -->
        <div class="sdg2-lang">
          <button class="sdg2-badge sdg2-lang-btn" aria-label="Language" type="button">EN</button>
          <span class="sdg2-caret" aria-hidden="true"></span>
        </div>
      </div>
    </div>

    <!-- subtitle -->
    <p class="sdg2-subtitle">
      Achieving the ‘Zero Hunger’ Sustainable Development Goal, without breaching the 1.5°C threshold
    </p>

    <?php if ( $hero_url ) : ?>
      <img class="sdg2-hero" src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( $page_title ?: 'Hero image' ); ?>">
    <?php else: ?>
      <!-- Optional: fallback image if no Featured Image set -->
      <!-- <img class="sdg2-hero" src="https://your-site.com/path/to/your-image.jpg" alt="Hero image"> -->
    <?php endif; ?>

    <h2 class="sdg2-title">
      Achieving the ‘Zero Hunger’ Sustainable Development Goal, without breaching the 1.5°C threshold
    </h2>

    <div class="sdg2-body">
      <p>Grano Flame is participating in the development of a Danish vision supporting the FAO Global Roadmap, seeking to align climate and nutrition objectives. The Danish contribution to the FAO Global Roadmap will be part of the global project ‘Achieving SDG 2 without breaching the 1.5 °C threshold’, initiated by the UN Food and Agriculture Organization (FAO). The project aims to accelerate and coordinate action to support the long-term sustainable development of agrifood systems at both global and national levels.</p>

      <p>Agrifood systems are responsible for a significant portion of global greenhouse gas emissions, while at the same time, millions of people suffer from hunger and unhealthy diets. Transforming agrifood systems is essential not only to ensure food security and nutrition for all but also to meet climate targets and protect natural ecosystems. The FAO Global Roadmap seeks to address these interlinked challenges by promoting equitable and sustainable solutions.</p>

      <p>The Danish contribution to the FAO Global Roadmap will build on existing efforts and aim to close gaps towards 2050. The FABLE Calculator will be the main tool used to model a future agrifood system scenario for Denmark, and part of a global modelling exercise. The modelling will be supported by an assessment of policy and solution gaps, exploration of innovative solutions such as alternative proteins, and engagement of stakeholders across government, civil society, the private sector, and academia to ensure the vision is shared and the roadmap is anchored and actionable in the national context.</p>

      <p>The Danish vision of the FAO Global Roadmap, developed alongside national visions for other FAO Global Roadmap pilot countries aims to serve as an actionable plan guiding the transition to climate-neutral agrifood and land-use systems domestically by 2050 within a global context. The next steps of the project will be to estimate cost and the needed effort for implementation as well as investment cases for financing.</p>

      <p>This initiative supports Denmark’s efforts to achieve sustainable agrifood systems while contributing to a scalable framework for global use, fostering knowledge exchange, advancing international partnerships, and facilitating investments directed towards the green transition. It builds upon the FAO Global Roadmap, which emphasizes addressing inequalities, improving efficiencies, and tackling key domains such as sustainable energy use, food waste reduction, and equitable dietary transitions.</p>
    </div>

    <aside class="sdg2-inset" role="note">
      <p>This project is a pilot initiative which aims to experiment with and build up experience in making long-term national plans for food systems, based on robust modelling, which can help leverage funding for countries to deliver on global sustainability goals towards 2050. It provides a clear framework and method, which can be applied in any country as a bottom-up approach for addressing global agendas in a nationally appropriate way, supplementing existing plans such as the Nationally Determined Contributions (NDCs) and the Long-term low-emission development strategies (LT-LEDS) and build on those to close gaps.</p>
    </aside>

    <footer class="sdg2-info">
      <div>
        <p>Læderstræde 20<br>1201 Copenhagen<br>Denmark</p>
        <p><a href="mailto:info@granoflame.dk">info@granoflame.dk</a></p>
      </div>
      <div>
        <p>Grano Flame is an independent knowledge partner for decision-makers across Danish society – politicians, business, academia and civil society.</p>
        <p>Our purpose is to translate relevant knowledge into climate action and thereby accelerate the green transition both in Denmark and internationally.</p>
      </div>
    </footer>

  </div>
</main>

<?php wp_footer(); ?>
</body>
</html>
