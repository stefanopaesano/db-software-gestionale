
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    
    
</head>
<body>

      
    @extends('layouts.app')

    @section('content')

      <!-- Sezione Hero -->
        <section class="hero">
            <div class="hero-content">
                
                <h1>Benvenuto nella nostra App</h1>
                <p>Offriamo soluzioni innovative e scalabili per la tua attività!</p>
                
            </div>
        </section>

        <!-- Sezione Dettagli Aziendali -->
            
             <h1 style="text-align: Center">I Nostri Servizi </h1>

            <section id="services" class="dettagli-azienda">
      
                    <!-- Box 1 -->
                <div class="service-box">
                    <i class="fas fa-cogs"></i>
                    <h3>Innovazione Tecnologica</h3>
                    <p>Utilizziamo le tecnologie più avanzate per garantire soluzioni scalabili ed efficienti.</p>
                </div>

                <!-- Box 2 -->
                <div class="service-box">
                    <i class="fas fa-headset"></i>
                    <h3>Assistenza Clienti</h3>
                    <p>Il nostro team è sempre disponibile per supportarti, offriamo assistenza dedicata e consulenze personalizzate.</p>
                </div>

                <!-- Box 3 -->
                <div class="service-box">
                    <i class="fas fa-chart-line"></i>
                    <h3>Ricerca & Sviluppo</h3>
                    <p>Investiamo continuamente in ricerca e sviluppo per migliorare i nostri servizi e garantire la qualità.</p>
                </div>

               

            </section>

      
  
      
  
  
    @endsection
  
        

      

        


    

    



    
    
</body>
</html>
