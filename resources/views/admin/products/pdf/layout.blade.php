<!doctype html>
<html>
<head>
	<title>
	@yield('title') | Laravel Test
	</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }
            header {
                position: fixed;
                top: -100px;
                left: -60px;
                right: -30px;
                height: 100px;
                /** Extra personal styles **/
                background-color: rgb(192, 185, 178);
                color: rgb(70, 38, 8);
                text-align: center;                
                line-height: 35px;
                margin-bottom: 10px;
                display: block;
                font-size: 10pt;
            }
            footer {
                position: fixed; 
                bottom: -100px; 
                left: -30px; 
                right: -30px;
                height: 100px; 
                /** Extra personal styles **/
                background-color: rgb(192, 185, 178);
                color: rgb(70, 38, 8);
                text-align: center;
                font-size: 10pt;
                font-weight: bold;
                
                padding-left: 40px;
                padding-right: 35px;
            }
            
            .page-break {
                page-break-before: always;
            }
            
            body {
                font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; 
                font-size: 12pt;
                margin-left: 60px;
                margin-right: 60px;
            }
            
            h1, h2 {
                color: rgb(0, 23, 57);
                margin-bottom: 10px;
            }
            
            h5 {
                margin-bottom: 2px;
            }
            
            small {
                font-size: 10pt;
            }
            
            table {
                text-align: center;
                border: 1px solid #ddd;
                width: 100%;
                border-spacing:0;
            }
            
            .table-bordered {
                border: 1px solid #ddd;
            }
            
            .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
                border: 1px solid #ddd;
            }
            
            .table-striped>tbody>tr:nth-of-type(odd) {
                background-color: #f9f9f9;
            }
            
            .img-fluid {
                max-width: 300px;
				margin-top: 10px;
            }            
            .header .page-number:after { 
                content: counter(page); 
            }
            
            .container {
                width: 100%;
                padding-right: var(--bs-gutter-x,.75rem);
                padding-left: var(--bs-gutter-x,.75rem);
                margin-right: auto;
                margin-left: auto;
                background-color: rgb(192, 185, 178);
                text-align: right;
                
            }
            row{
                --bs-gutter-x:1.5rem;
                --bs-gutter-y:0;
                display:flex;
                flex-wrap:wrap;
                margin-top:calc(var(--bs-gutter-y) * -1);
                margin-right:calc(var(--bs-gutter-x)/ -2);
                margin-left:calc(var(--bs-gutter-x)/ -2)
           }
           
           .row>*{
            flex-shrink:0;
            width:100%;
            max-width:100%;
            padding-right:calc(var(--bs-gutter-x)/ 2);
            padding-left:calc(var(--bs-gutter-x)/ 2);
            margin-top:var(--bs-gutter-y)
           }
           
           .title {
            font-size: 22pt;
            color: rgb(70, 38, 8);
            margin-top: 100px;
            margin-right: 80px;
           }
        </style>
</head>
<body>
	<header class="d-flex flex-row-reverse">
		<div class="container">
    		<div class="row">
    			<div class="col-auto">
    				<span class="title">@yield('title')</span>
    			</div>
    		</div>
    	</div>
	</header>
	<main>
	@yield('content')	
    </main>
    
    <footer>
    </footer>
    
    <script type="text/php">
    if (isset($pdf)) {
        $x = 250;
        $y = 810;
        $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
        $font = null;
        $size = 10;
        $color = array(.275, .149, .031);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
</body>
</html>