<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JMY EARN MONEY</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logos.png') }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('frontend/css/style1.css') }}" rel="stylesheet" >
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css" integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9489624253487221"
     crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <component :is="$route.meta.layout || 'div'" >
            <router-view />
          </component>

    </div>
    <script>
console.log("{{ Auth::user() }}")

        if ("{{ Auth::user() }}") {

            const storeToken = localStorage.getItem('token');


            if(!storeToken){

                let data = {'_token': "{{ csrf_token() }}"};
                fetch("/logout", {
                method: "POST",
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
                }).then(res => {

                });

                // axios.post('/logout').then(()=>{
                //     // window.location.href = '/'
                // })
            }


        }else{

                localStorage.removeItem('token')
                localStorage.removeItem('user')
                localStorage.removeItem('userid')
                localStorage.removeItem('role')
                localStorage.removeItem('position')
        }

        </script>

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/frontend.js?ver=1.1.1') }}"></script>



</body>
</html>
