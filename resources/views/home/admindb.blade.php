<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KAI DAOP 7</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

   @include('layout.partial.link')

</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
@include('layout.partial.header')
   
    <!--Container-->
    <div class="container w-full mx-auto pt-20">
        
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <!--Console Content-->

            <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-3">
    <!--Metric Card-->
    <div class="bg-white border rounded shadow p-2" style="cursor: pointer;" onclick="window.location='{{ route('adminhome') }}'">
        <div class="flex flex-row items-center">
            <div class="flex-shrink pr-4">
                <div class="rounded p-3 bg-blue-600">
                <i class="fas fa-clipboard-list fa-2x fa-fw fa-inverse"></i>
                </div>
            </div>
            <div class="flex-1 text-right md:text-center">
                <h5 class="font-bold uppercase text-gray-500">Home</h5>
                <h3 class="font-bold text-3xl">2</h3>
            </div>
        </div>
    </div>
    <!--/Metric Card-->
</div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2" style="cursor: pointer;" onclick="window.location='{{ route('adminhome') }}'" >
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-600"><i class="fas fa-clipboard-list fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Tentang Kami</h5>
                                <h3 class="font-bold text-3xl">2</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-blue-600"><i class="fas fa-clipboard-list fa-2x fa-fw fa-inverse"></i></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Visi Misi</h5>
                                <h3 class="font-bold text-3xl">2</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
    <!--Metric Card-->
    <div class="bg-white border rounded shadow p-2" style="cursor: pointer;" onclick="window.location='{{ route('viewuser') }}'">
        <div class="flex flex-row items-center">
            <div class="flex-shrink pr-4">
                <div class="rounded p-3 bg-pink-600"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i></div>
            </div>
            <div class="flex-1 text-right md:text-center">
                <h5 class="font-bold uppercase text-gray-500">Struktur Organisasi</h5>
                <h3 class="font-bold text-3xl"> <span class="text-pink-500"></span></h3>
            </div>
        </div>
    </div>
    <!--/Metric Card-->
</div>
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2"  style="cursor: pointer;" onclick="window.location='{{ route('viewkatalog') }}'">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-yellow-600"><i class="fas fa-warehouse fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Peta wilayah kerja</h5>
                                <h3 class="font-bold text-3xl"> <span class="text-pink-500"></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div> 

   <!--Divider-->
<hr class="border-b-2 border-gray-400 my-8 mx-4">

<div class="flex flex-row flex-wrap flex-grow mt-2">
    <div class="w-full p-3">
       
    </div>
</div>
                <div class="w-full md:w-1/2 p-3">
                    <!--Graph Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                        </div>
                        <div class="p-5">
                            <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                            new Chart(document.getElementById("chartjs-0"), {
                                "type": "line",
                                "data": {
                                    "labels": ["January", "February", "March", "April", "May", "June", "July"],
                                    "datasets": [{
                                        "label": "Views",
                                        "data": [65, 59, 80, 81, 56, 55, 40],
                                        "fill": false,
                                        "borderColor": "rgb(75, 192, 192)",
                                        "lineTension": 0.1
                                    }]
                                },
                                "options": {}
                            });
                            </script>
                        </div>
                    </div>
                    <!--/Graph Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Template Card-->
                    
                </div>


            </div>

            <!--/ Console Content-->

        </div>


    </div>
    <!--/container-->
    @yield('content')
@include('layout.partial.footer')   
</body>
@include('layout.partial.script')
</html>
