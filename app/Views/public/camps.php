<?php helper('text'); ?>
<?= $this->extend('public/layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, rgba(76, 29, 149, 0.95) 0%, rgba(168, 85, 247, 0.5) 100%); padding: 100px 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 15px;">Medical Camps</h1>
                <p style="font-size: 24px; opacity: 0.95; line-height: 1.6;">नियमित चिकित्सा शिविरों और जागरूकता कार्यक्रमों के माध्यम से हम अपने सामुदायिक स्वास्थ्य के प्रति अपने  दायित्व का निर्वहन करते है।</p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="bi bi-people-fill" style="font-size: 100px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Intro Section -->
<section style="background: white; padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 style="font-weight: 800; font-size: 36px; color: #1a1a2e; margin-bottom: 20px;">Community Health Initiatives</h2>
                <p style="font-size: 24px; color: #666; line-height: 1.8;">शंकर नर्सिंग होम समाज के पिछड़े, गरीब एवं दूरस्थ क्षेत्रों में रहने वाले लोगों तक स्वास्थ्य जागरूकता फैलाने तथा समुदाय को निःशुल्क परामर्श प्रदान करने के लिए नियमित चिकित्सा शिविरों का आयोजन करता है। 

हमारे समर्पित डॉक्टरों और स्वास्थ्य विशेषज्ञों की टीम गुणवत्तापूर्ण उपचार और सही मार्गदर्शन हर जरूरतमंद व्यक्ति तक पहुँचाने के लिए निरंतर प्रयासरत रहती है।</p>
            </div>
        </div>
    </div>
</section>

<!-- Camps Gallery -->
<section style="background: #f8f9fa; padding: 100px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-weight: 800; font-size: 42px; color: #1a1a2e; margin-bottom: 15px;">Our Recent Camps</h2>
            <p style="font-size: 18px; color: #666;">Bringing healthcare and awareness to communities across the region</p>
        </div>
        
        <div class="row g-4">
            <?php if (!empty($camps)): ?>
                <?php foreach ($camps as $camp): ?>
                    <div class="col-md-6 col-lg-4">
                        <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%; display: flex; flex-direction: column;">
                            <!-- Image Container -->
                            <div style="position: relative; overflow: hidden; height: 450px; background: linear-gradient(135deg, rgba(76, 29, 149, 0.3) 0%, rgba(168, 85, 247, 0.2) 100%); display: flex; align-items: center; justify-content: center;">
                                <img src="<?= base_url($camp['image']) ?>" alt="<?= esc($camp['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(76, 29, 149, 0.6) 0%, rgba(168, 85, 247, 0.4) 100%); opacity: 0; transition: opacity 0.3s ease;" class="camp-overlay"></div>
                            </div>
                            
                            <!-- Content -->
                            <div style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">
                                <h4 style="font-weight: 700; font-size: 20px; color: #1a1a2e; margin-bottom: 12px;"><?= esc($camp['title']) ?></h4>
                                <p style="color: #666; font-size: 15px; line-height: 1.6; flex-grow: 1;"><?= esc($camp['description']) ?></p>
                                <a href="<?= base_url('contact') ?>" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); color: white; text-decoration: none; border-radius: 20px; font-weight: 600; font-size: 14px; transition: all 0.3s ease;">
                                    <i class="bi bi-arrow-right me-1"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p style="font-size: 18px; color: #666;">No camps available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); padding: 80px 0; color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 20% 50%, rgba(168, 85, 247, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.05) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row text-center">
            <div class="col-md-6 col-lg-3">
                <div style="padding: 30px; transition: all 0.3s ease;">
                    <div style="font-size: 50px; color: #A855F7; margin-bottom: 20px;"><i class="bi bi-calendar2-event"></i></div>
                    <div style="font-size: 36px; font-weight: 800; margin: 15px 0;">25+</div>
                    <div style="font-size: 16px; opacity: 0.9;">Camps Organized</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div style="padding: 30px; transition: all 0.3s ease;">
                    <div style="font-size: 50px; color: #A855F7; margin-bottom: 20px;"><i class="bi bi-people"></i></div>
                    <div style="font-size: 36px; font-weight: 800; margin: 15px 0;">5,000+</div>
                    <div style="font-size: 16px; opacity: 0.9;">People Benefited</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div style="padding: 30px; transition: all 0.3s ease;">
                    <div style="font-size: 50px; color: #A855F7; margin-bottom: 20px;"><i class="bi bi-hospital"></i></div>
                    <div style="font-size: 36px; font-weight: 800; margin: 15px 0;">50+</div>
                    <div style="font-size: 16px; opacity: 0.9;">Doctors Involved</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div style="padding: 30px; transition: all 0.3s ease;">
                    <div style="font-size: 50px; color: #A855F7; margin-bottom: 20px;"><i class="bi bi-award"></i></div>
                    <div style="font-size: 36px; font-weight: 800; margin: 15px 0;">Free</div>
                    <div style="font-size: 16px; opacity: 0.9;">Health Checkups</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="background: white; padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 style="font-weight: 800; font-size: 36px; color: #1a1a2e; margin-bottom: 20px;">Be Part of Our Health Mission</h2>
                <p style="font-size: 17px; color: #666; line-height: 1.8; margin-bottom: 20px;">Get free health checkups and medical consultations at our regular camps. We bring quality healthcare to your doorstep.</p>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 15px; display: flex; align-items: center; color: #666;">
                        <i class="bi bi-check-circle-fill" style="color: var(--primary-color); font-size: 24px; margin-right: 15px;"></i>
                        <span style="font-size: 16px;">Free Health Consultations</span>
                    </li>
                    <li style="margin-bottom: 15px; display: flex; align-items: center; color: #666;">
                        <i class="bi bi-check-circle-fill" style="color: var(--primary-color); font-size: 24px; margin-right: 15px;"></i>
                        <span style="font-size: 16px;">Expert Medical Advice</span>
                    </li>
                    <li style="margin-bottom: 15px; display: flex; align-items: center; color: #666;">
                        <i class="bi bi-check-circle-fill" style="color: var(--primary-color); font-size: 24px; margin-right: 15px;"></i>
                        <span style="font-size: 16px;">Health Awareness Programs</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 25px; padding: 50px; color: white; box-shadow: 0 20px 60px rgba(124, 58, 237, 0.2);">
                    <h3 style="font-weight: 800; font-size: 28px; margin-bottom: 20px;">Register for Next Camp</h3>
                    <p style="font-size: 16px; margin-bottom: 30px; opacity: 0.95;">Contact us to know about upcoming medical camps and registration details.</p>
                    <a href="<?= base_url('contact') ?>" style="display: inline-block; padding: 15px 35px; background: white; color: #7C3AED; text-decoration: none; border-radius: 25px; font-weight: 700; font-size: 16px; transition: all 0.3s ease;">
                        <i class="bi bi-telephone me-2"></i>Contact Us Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @media (hover: hover) {
        [style*="flex-direction: column"] > div:nth-child(1):hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(124, 58, 237, 0.2) !important;
        }
        
        [style*="flex-direction: column"] > div:nth-child(1):hover img {
            transform: scale(1.05);
        }
        
        [style*="flex-direction: column"] > div:nth-child(1):hover .camp-overlay {
            opacity: 1 !important;
        }
    }
</style>

<?= $this->endSection() ?>
