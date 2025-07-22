<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المشاريع المتاحة - FreelanGo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.rtl.min.css">
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/pages.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <i class="fas fa-rocket"></i> FreelanGo
            </div>
            
            <div class="navbar-content">
                <ul class="navbar-links">
                    <li><a href="index.html"><i class="fas fa-home"></i> الرئيسية</a></li>
                    <li><a href="projects.html" class="active"><i class="fas fa-project-diagram"></i> المشاريع</a></li>
                    <li><a href="profile.html"><i class="fas fa-user-circle"></i> حسابي</a></li>
                    <li><a href="messages.html"><i class="fas fa-comments"></i> الرسائل</a></li>
                </ul>
            </div>
            <div class="navbar-actions">
                <a href="login.html" class="btn-apply"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</a>
            </div>
        </div>
    </nav>
    
    <header class="main-header">
        <div class="container">
            <h1><i class="fas fa-project-diagram"></i> المشاريع المتاحة</h1>
            <p>تصفح أحدث المشاريع المنشورة وابدأ العمل مع أفضل المحترفين</p>
            
            <div class="search-container">
                <input type="text" id="search" placeholder="ابحث عن مشروع حسب التخصص، المهارات، أو الكلمات المفتاحية..." />
                <button class="search-btn"><i class="fas fa-search"></i> بحث</button>
            </div>
            
            <div class="stats-container">
                <div class="stat-card">
                    <i class="fas fa-project-diagram"></i>
                    <div>
                        <div class="stat-value">1,248</div>
                        <div class="stat-label">مشروع نشط</div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div>
                        <div class="stat-value">5,742</div>
                        <div class="stat-label">محترف مسجل</div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-handshake"></i>
                    <div>
                        <div class="stat-value">3,896</div>
                        <div class="stat-label">مشروع مكتمل</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="layout">
            <aside class="filters-sidebar">
                <h3><i class="fas fa-filter"></i> فلترة المشاريع</h3>
                
                <div class="filter-group">
                    <label for="category"><i class="fas fa-folder"></i> التصنيف:</label>
                    <select id="category">
                        <option>الكل</option>
                        <option>برمجة وتطوير</option>
                        <option>تصميم جرافيك</option>
                        <option>كتابة وترجمة</option>
                        <option>تسويق إلكتروني</option>
                        <option>تصميم صوت وفيديو</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label><i class="fas fa-money-bill-wave"></i> الميزانية ($):</label>
                    <div class="budget-range">
                        <input type="number" placeholder="من" id="budgetMin" />
                        <input type="number" placeholder="إلى" id="budgetMax" />
                    </div>
                </div>
                
                <div class="filter-group">
                    <label for="duration"><i class="fas fa-clock"></i> المدة:</label>
                    <select id="duration">
                        <option>الكل</option>
                        <option>أقل من 3 أيام</option>
                        <option>3 - 7 أيام</option>
                        <option>أسبوع - أسبوعين</option>
                        <option>أكثر من أسبوعين</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="experience"><i class="fas fa-star"></i> مستوى الخبرة:</label>
                    <select id="experience">
                        <option>الكل</option>
                        <option>مبتدئ</option>
                        <option>متوسط</option>
                        <option>خبير</option>
                    </select>
                </div>
                
                <button class="btn-filter"><i class="fas fa-check"></i> تطبيق الفلاتر</button>
                <button class="btn-filter reset-btn"><i class="fas fa-redo"></i> إعادة تعيين</button>
            </aside>
            
            <main class="projects-section">
                <div class="projects-header">
                    <h2><i class="fas fa-list"></i> المشاريع المتاحة</h2>
                    <div class="sort-container">
                        <label for="sort"><i class="fas fa-sort"></i> ترتيب حسب:</label>
                        <select id="sort">
                            <option>الأحدث</option>
                            <option>الأعلى سعراً</option>
                            <option>الأقرب موعداً</option>
                            <option>الأكثر تطابقاً</option>
                        </select>
                    </div>
                </div>
                
                <div class="projects-container" id="projectsList">
                    <div class="project-card">
                        <h2><i class="fas fa-paint-brush"></i> تصميم واجهة متجر إلكتروني</h2>
                        <p class="project-desc">نبحث عن مصمم محترف لإنشاء واجهة متجر متجاوبة باستخدام Figma أو Adobe XD. يجب أن تكون التصاميم عصرية وتواكب أحدث اتجاهات UI/UX.</p>
                        <div class="project-meta">
                            <div class="meta-item"><i class="fas fa-money-bill"></i> 300$ - 500$</div>
                            <div class="meta-item"><i class="fas fa-clock"></i> 5 أيام</div>
                            <div class="meta-item"><i class="fas fa-briefcase"></i> 3 عروض</div>
                        </div>
                        <div class="project-footer">
                            <span class="project-category">تصميم جرافيك</span>
                            <button class="btn-apply"><i class="fas fa-paper-plane"></i> تقديم عرض</button>
                        </div>
                    </div>
                    
                    <div class="project-card">
                        <h2><i class="fas fa-code"></i> تطوير API لنظام حجوزات</h2>
                        <p class="project-desc">مطلوب مبرمج Laravel لتطوير API كامل لنظام حجوزات طبي مع دعم نظام دفع إلكتروني وتكامل مع Google Calendar. الخبرة السابقة في مشاريع مشابهة مطلوبة.</p>
                        <div class="project-meta">
                            <div class="meta-item"><i class="fas fa-money-bill"></i> 500$ - 800$</div>
                            <div class="meta-item"><i class="fas fa-clock"></i> 10 أيام</div>
                            <div class="meta-item"><i class="fas fa-briefcase"></i> 8 عروض</div>
                        </div>
                        <div class="project-footer">
                            <span class="project-category">برمجة وتطوير</span>
                            <button class="btn-apply"><i class="fas fa-paper-plane"></i> تقديم عرض</button>
                        </div>
                    </div>
                    
                    <div class="project-card">
                        <h2><i class="fas fa-language"></i> ترجمة موقع إلكتروني</h2>
                        <p class="project-desc">ترجمة محتوى موقع من العربية إلى الإنجليزية (حوالي 5000 كلمة) مع التدقيق اللغوي وضمان الجودة. يجب أن يكون المترجم متخصص في المجال التقني.</p>
                        <div class="project-meta">
                            <div class="meta-item"><i class="fas fa-money-bill"></i> 150$ - 250$</div>
                            <div class="meta-item"><i class="fas fa-clock"></i> 3 أيام</div>
                            <div class="meta-item"><i class="fas fa-briefcase"></i> 12 عروض</div>
                        </div>
                        <div class="project-footer">
                            <span class="project-category">كتابة وترجمة</span>
                            <button class="btn-apply"><i class="fas fa-paper-plane"></i> تقديم عرض</button>
                        </div>
                    </div>
                    
                    <div class="project-card">
                        <h2><i class="fas fa-bullhorn"></i> حملة تسويقية على السوشيال ميديا</h2>
                        <p class="project-desc">مطلوب مسوق إلكتروني لتنفيذ حملة تسويقية لمنتج جديد على منصات التواصل الاجتماعي (فيسبوك، إنستغرام، تويتر). يشمل التخطيط، التنفيذ، والمتابعة.</p>
                        <div class="project-meta">
                            <div class="meta-item"><i class="fas fa-money-bill"></i> 400$ - 600$</div>
                            <div class="meta-item"><i class="fas fa-clock"></i> 7 أيام</div>
                            <div class="meta-item"><i class="fas fa-briefcase"></i> 5 عروض</div>
                        </div>
                        <div class="project-footer">
                            <span class="project-category">تسويق إلكتروني</span>
                            <button class="btn-apply"><i class="fas fa-paper-plane"></i> تقديم عرض</button>
                        </div>
                    </div>
                    
                    <div class="project-card">
                        <h2><i class="fas fa-video"></i> مونتاج فيديو ترويجي</h2>
                        <p class="project-desc">مطلوب محرر فيديو محترف لإنشاء فيديو ترويجي مدته 60-90 ثانية من مواد خام موجودة. يجب أن يشمل المؤثرات البصرية، الرسوم المتحركة، والموسيقى التصويرية.</p>
                        <div class="project-meta">
                            <div class="meta-item"><i class="fas fa-money-bill"></i> 200$ - 350$</div>
                            <div class="meta-item"><i class="fas fa-clock"></i> 4 أيام</div>
                            <div class="meta-item"><i class="fas fa-briefcase"></i> 7 عروض</div>
                        </div>
                        <div class="project-footer">
                            <span class="project-category">تصميم صوت وفيديو</span>
                            <button class="btn-apply"><i class="fas fa-paper-plane"></i> تقديم عرض</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>عن FreelanGo</h3>
                    <p>منصة عربية تربط بين أصحاب المشاريع والمحترفين المستقلين لتنفيذ الأعمال بكفاءة وابتكارية.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>روابط سريعة</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-left"></i> الرئيسية</a></li>
                        <li><a href="#"><i class="fas fa-chevron-left"></i> المشاريع</a></li>
                        <li><a href="#"><i class="fas fa-chevron-left"></i> المستقلون</a></li>
                        <li><a href="#"><i class="fas fa-chevron-left"></i> المدونة</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>الدعم والمساعدة</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-left"></i> مركز المساعدة</a></li>
                        <li><a href="#"><i class="fas fa-chevron-left"></i> الأسئلة الشائعة</a></li>
                        <li><a href="#"><i class="fas fa-chevron-left"></i> سياسة الاستخدام</a></li>
                        <li><a href="#"><i class="fas fa-chevron-left"></i> تواصل معنا</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                © 2023 FreelanGo. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>
     <script src="../js/forgot-password.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/project.js"></script>
</body>
</html>