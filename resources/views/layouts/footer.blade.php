<!-- Footer -->
    <footer class="py-16 px-6 border-t border-slate-800">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-5 gap-8 mb-12">
            <div class="md:col-span-2">
            <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div><span class="text-xl font-bold">EduFlow</span>
            </div>
            <p class="text-slate-400 text-sm leading-relaxed max-w-xs">Empowering educational institutions with modern management tools for a brighter future.</p>
            </div>
            <div>
            <h4 class="font-semibold mb-4">Product</h4>
            <ul class="space-y-2 text-sm text-slate-400">
            <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Updates</a></li>
            </ul>
            </div>
            <div>
            <h4 class="font-semibold mb-4">Company</h4>
            <ul class="space-y-2 text-sm text-slate-400">
            <li><a href="#" class="hover:text-white transition-colors">About</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
            </ul>
            </div>
            <div>
            <h4 class="font-semibold mb-4">Support</h4>
            <ul class="space-y-2 text-sm text-slate-400">
            <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
            </ul>
            </div>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between pt-8 border-t border-slate-800">
            <p id="footer-text" class="text-slate-500 text-sm">© 2026 EduFlow. All rights reserved.</p>
            <div class="flex items-center gap-6 mt-4 md:mt-0"><a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Privacy</a> <a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Terms</a> <a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Cookies</a>
            </div>
            </div>
        </div>
    </footer>
</div>
  <script>
    const defaultConfig = {
      hero_title: 'Transform Your School Management Today',
      hero_subtitle: 'The all-in-one platform that simplifies administration, enhances learning, and connects your entire school community seamlessly.',
      cta_button_text: 'Get Started Free',
      features_title: 'Everything You Need to Run Your School',
      footer_text: '© 2024 EduFlow. All rights reserved.',
      background_color: '#0f172a',
      surface_color: '#1e293b',
      text_color: '#e2e8f0',
      primary_action_color: '#2563eb',
      secondary_action_color: '#06b6d4',
      font_family: 'Plus Jakarta Sans',
      font_size: 16
    };

    async function onConfigChange(config) {
      const heroTitle = document.getElementById('hero-title');
      const heroSubtitle = document.getElementById('hero-subtitle');
      const heroCta = document.getElementById('hero-cta');
      const navCta = document.getElementById('nav-cta');
      const featuresTitle = document.getElementById('features-title');
      const footerText = document.getElementById('footer-text');

      const title = config.hero_title || defaultConfig.hero_title;
      const titleParts = title.split(' ');
      const midPoint = Math.ceil(titleParts.length / 2);
      heroTitle.innerHTML = `
        <span class="bg-gradient-to-r from-white via-slate-200 to-slate-400 bg-clip-text text-transparent">${titleParts.slice(0, midPoint).join(' ')}</span>
        <br>
        <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">${titleParts.slice(midPoint).join(' ')}</span>
      `;

      heroSubtitle.textContent = config.hero_subtitle || defaultConfig.hero_subtitle;
      
      const ctaText = config.cta_button_text || defaultConfig.cta_button_text;
      heroCta.innerHTML = `${ctaText} <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>`;
      navCta.textContent = ctaText.split(' ').slice(0, 2).join(' ');
      
      featuresTitle.textContent = config.features_title || defaultConfig.features_title;
      footerText.textContent = config.footer_text || defaultConfig.footer_text;

      const bgColor = config.background_color || defaultConfig.background_color;
      const surfaceColor = config.surface_color || defaultConfig.surface_color;
      const textColor = config.text_color || defaultConfig.text_color;
      const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;
      const secondaryColor = config.secondary_action_color || defaultConfig.secondary_action_color;

      document.body.style.background = `linear-gradient(135deg, ${bgColor} 0%, ${surfaceColor} 50%, ${bgColor} 100%)`;
      document.body.style.color = textColor;

      const fontFamily = config.font_family || defaultConfig.font_family;
      const baseSize = config.font_size || defaultConfig.font_size;
      document.body.style.fontFamily = `${fontFamily}, sans-serif`;
      
      heroTitle.style.fontSize = `${baseSize * 3.5}px`;
      heroSubtitle.style.fontSize = `${baseSize * 1.125}px`;
      featuresTitle.style.fontSize = `${baseSize * 2.5}px`;
    }

    function mapToCapabilities(config) {
      return {
        recolorables: [
          {
            get: () => config.background_color || defaultConfig.background_color,
            set: (value) => { config.background_color = value; window.elementSdk.setConfig({ background_color: value }); }
          },
          {
            get: () => config.surface_color || defaultConfig.surface_color,
            set: (value) => { config.surface_color = value; window.elementSdk.setConfig({ surface_color: value }); }
          },
          {
            get: () => config.text_color || defaultConfig.text_color,
            set: (value) => { config.text_color = value; window.elementSdk.setConfig({ text_color: value }); }
          },
          {
            get: () => config.primary_action_color || defaultConfig.primary_action_color,
            set: (value) => { config.primary_action_color = value; window.elementSdk.setConfig({ primary_action_color: value }); }
          },
          {
            get: () => config.secondary_action_color || defaultConfig.secondary_action_color,
            set: (value) => { config.secondary_action_color = value; window.elementSdk.setConfig({ secondary_action_color: value }); }
          }
        ],
        borderables: [],
        fontEditable: {
          get: () => config.font_family || defaultConfig.font_family,
          set: (value) => { config.font_family = value; window.elementSdk.setConfig({ font_family: value }); }
        },
        fontSizeable: {
          get: () => config.font_size || defaultConfig.font_size,
          set: (value) => { config.font_size = value; window.elementSdk.setConfig({ font_size: value }); }
        }
      };
    }

    function mapToEditPanelValues(config) {
      return new Map([
        ['hero_title', config.hero_title || defaultConfig.hero_title],
        ['hero_subtitle', config.hero_subtitle || defaultConfig.hero_subtitle],
        ['cta_button_text', config.cta_button_text || defaultConfig.cta_button_text],
        ['features_title', config.features_title || defaultConfig.features_title],
        ['footer_text', config.footer_text || defaultConfig.footer_text]
      ]);
    }

    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
      });
    }

    // Smooth scroll for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  </script>
@flasher_render_js
</body>
</html>