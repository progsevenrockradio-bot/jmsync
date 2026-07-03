# Script de copia de activos del tema Nexus → jmsync
# Ejecutar desde: C:\laragon\www\jmsync.es\jmsync

$theme = "C:\laragon\www\jmsync.es\nexus-atmxxl\nexus"
$project = "C:\laragon\www\jmsync.es\jmsync"

Write-Host "=== Copiando activos del tema Nexus a jmsync ===" -ForegroundColor Cyan

# Crear directorios destino
$dirs = @(
    "resources\css\theme",
    "resources\css\theme\ilightbox-skins",
    "resources\js\theme",
    "public\fonts",
    "public\images\ilightbox",
    "public\images\theme"
)

foreach ($dir in $dirs) {
    $fullPath = Join-Path $project $dir
    if (-not (Test-Path $fullPath)) {
        New-Item -ItemType Directory -Path $fullPath -Force | Out-Null
        Write-Host "  Creado: $dir" -ForegroundColor Green
    }
}

# --- Copiar CSS ---
Write-Host "`n[CSS]" -ForegroundColor Yellow

# animate.css
Copy-Item "$theme\css\animate.css" "$project\resources\css\theme\animate.css" -Force
Write-Host "  animate.css" -ForegroundColor Green

# fontello.css
Copy-Item "$theme\css\fontello.css" "$project\resources\css\theme\fontello.css" -Force
Write-Host "  fontello.css" -ForegroundColor Green

# ilightbox.css
Copy-Item "$theme\css\ilightbox.css" "$project\resources\css\theme\ilightbox.css" -Force
Write-Host "  ilightbox.css" -ForegroundColor Green

# style.css (main theme styles - 280KB)
Copy-Item "$theme\theme-framework\theme-style\css\style.css" "$project\resources\css\theme\style.css" -Force
Write-Host "  style.css (framework)" -ForegroundColor Green

# adaptive.css (responsive)
Copy-Item "$theme\theme-framework\theme-style\css\adaptive.css" "$project\resources\css\theme\adaptive.css" -Force
Write-Host "  adaptive.css" -ForegroundColor Green

# retina.css
Copy-Item "$theme\theme-framework\theme-style\css\retina.css" "$project\resources\css\theme\retina.css" -Force
Write-Host "  retina.css" -ForegroundColor Green

# fontello-custom.css
Copy-Item "$theme\theme-vars\theme-style\css\fontello-custom.css" "$project\resources\css\theme\fontello-custom.css" -Force
Write-Host "  fontello-custom.css" -ForegroundColor Green

# vars-style.css
Copy-Item "$theme\theme-vars\theme-style\css\vars-style.css" "$project\resources\css\theme\vars-style.css" -Force
Write-Host "  vars-style.css" -ForegroundColor Green

# boldest.css (Google Fonts embedded - 445KB) — copiado a public para servir directamente
Copy-Item "$theme\theme-vars\theme-style\css\styles\boldest.css" "$project\public\boldest.css" -Force
Write-Host "  boldest.css → public/" -ForegroundColor Green

# ilightbox-skins
Copy-Item "$theme\css\ilightbox-skins\*" "$project\resources\css\theme\ilightbox-skins\" -Recurse -Force
Write-Host "  ilightbox-skins/" -ForegroundColor Green

# --- Copiar Fuentes ---
Write-Host "`n[Fonts]" -ForegroundColor Yellow

# fontello fonts
Copy-Item "$theme\css\fonts\fontello.eot" "$project\public\fonts\fontello.eot" -Force
Copy-Item "$theme\css\fonts\fontello.svg" "$project\public\fonts\fontello.svg" -Force
Copy-Item "$theme\css\fonts\fontello.ttf" "$project\public\fonts\fontello.ttf" -Force
Copy-Item "$theme\css\fonts\fontello.woff" "$project\public\fonts\fontello.woff" -Force
Write-Host "  fontello.{eot,svg,ttf,woff}" -ForegroundColor Green

# fontello-custom fonts
Copy-Item "$theme\theme-vars\theme-style\css\fonts\fontello-custom.eot" "$project\public\fonts\fontello-custom.eot" -Force
Copy-Item "$theme\theme-vars\theme-style\css\fonts\fontello-custom.svg" "$project\public\fonts\fontello-custom.svg" -Force
Copy-Item "$theme\theme-vars\theme-style\css\fonts\fontello-custom.ttf" "$project\public\fonts\fontello-custom.ttf" -Force
Copy-Item "$theme\theme-vars\theme-style\css\fonts\fontello-custom.woff" "$project\public\fonts\fontello-custom.woff" -Force
Write-Host "  fontello-custom.{eot,svg,ttf,woff}" -ForegroundColor Green

# --- Copiar JavaScript ---
Write-Host "`n[JavaScript]" -ForegroundColor Yellow

$jsFiles = @(
    "jquery.script.js",
    "owlcarousel.min.js",
    "jquery.isotope.min.js",
    "waypoints.min.js",
    "stellar.min.js",
    "jquery.iLightBox.min.js",
    "easy-pie-chart.min.js",
    "easing.min.js",
    "scroll-to.min.js",
    "smooth-sticky.min.js",
    "scrollspy.js",
    "mousewheel.min.js",
    "debounced-resize.min.js"
)

foreach ($js in $jsFiles) {
    $src = "$theme\js\$js"
    if (Test-Path $src) {
        # Renombrar jquery.script.js → jmsync.script.js
        $destName = $js -replace "jquery\.script", "jmsync.script"
        Copy-Item $src "$project\resources\js\theme\$destName" -Force
        Write-Host "  $destName" -ForegroundColor Green
    }
}

# --- Copiar Imágenes de iLightbox ---
Write-Host "`n[Images - iLightbox]" -ForegroundColor Yellow
if (Test-Path "$theme\img\ilightbox") {
    Copy-Item "$theme\img\ilightbox\*" "$project\public\images\ilightbox\" -Recurse -Force
    Write-Host "  ilightbox skins copied" -ForegroundColor Green
}
Copy-Item "$theme\img\select.png" "$project\public\images\theme\select.png" -Force
Write-Host "  select.png" -ForegroundColor Green

# --- Ajustar rutas de fuentes en los CSS copiados ---
Write-Host "`n[Ajustando rutas en CSS]" -ForegroundColor Yellow

# fontello.css: cambiar ../fonts/ → /fonts/
$fonteloCss = "$project\resources\css\theme\fontello.css"
$content = Get-Content $fonteloCss -Raw
$content = $content -replace "url\('\.\.\/fonts\/", "url('/fonts/"
$content = $content -replace 'url\("\.\.\/fonts\/', 'url("/fonts/'
$content = $content -replace "url\('fonts\/", "url('/fonts/"
$content = $content -replace 'url\("fonts\/', 'url("/fonts/'
Set-Content $fonteloCss $content -NoNewline
Write-Host "  fontello.css rutas actualizadas" -ForegroundColor Green

# fontello-custom.css: cambiar fonts/ → /fonts/
$fontelloCustomCss = "$project\resources\css\theme\fontello-custom.css"
$content = Get-Content $fontelloCustomCss -Raw
$content = $content -replace "url\('fonts\/", "url('/fonts/"
$content = $content -replace 'url\("fonts\/', 'url("/fonts/'
Set-Content $fontelloCustomCss $content -NoNewline
Write-Host "  fontello-custom.css rutas actualizadas" -ForegroundColor Green

# ilightbox.css: ajustar rutas de imágenes
$ilightboxCss = "$project\resources\css\theme\ilightbox.css"
$content = Get-Content $ilightboxCss -Raw
$content = $content -replace "url\('\.\.\/img\/", "url('/images/theme/"
$content = $content -replace 'url\("\.\.\/img\/', 'url("/images/theme/'
$content = $content -replace "url\('img\/", "url('/images/ilightbox/"
$content = $content -replace 'url\("img\/', 'url("/images/ilightbox/'
Set-Content $ilightboxCss $content -NoNewline
Write-Host "  ilightbox.css rutas actualizadas" -ForegroundColor Green

# --- Reemplazar nexus → jmsync en archivos CSS ---
Write-Host "`n[Renombrando nexus → jmsync en CSS]" -ForegroundColor Yellow

$cssFiles = Get-ChildItem "$project\resources\css\theme\" -Filter "*.css" -Recurse
foreach ($file in $cssFiles) {
    $content = Get-Content $file.FullName -Raw
    $newContent = $content `
        -replace "nexus", "jmsync" `
        -replace "Nexus", "Jmsync" `
        -replace "NEXUS", "JMSYNC"
    if ($newContent -ne $content) {
        Set-Content $file.FullName $newContent -NoNewline
        Write-Host "  $($file.Name) actualizado" -ForegroundColor Green
    }
}

# --- Reemplazar nexus → jmsync en JS del tema ---
Write-Host "`n[Renombrando nexus → jmsync en JS]" -ForegroundColor Yellow
$jsThemeFiles = Get-ChildItem "$project\resources\js\theme\" -Filter "*.js"
foreach ($file in $jsThemeFiles) {
    $content = Get-Content $file.FullName -Raw
    $newContent = $content `
        -replace "nexus", "jmsync" `
        -replace "Nexus", "Jmsync" `
        -replace "NEXUS", "JMSYNC"
    if ($newContent -ne $content) {
        Set-Content $file.FullName $newContent -NoNewline
        Write-Host "  $($file.Name) actualizado" -ForegroundColor Green
    }
}

Write-Host "`n=== Copia completada exitosamente ===" -ForegroundColor Cyan
