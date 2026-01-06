<!DOCTYPE html>
<html lang="es">
<head>
    @include('livewire.preingreso.pdf.metadata')
    @include('livewire.preingreso.pdf.css')
</head>
<body>
    @include('livewire.preingreso.pdf.cabecera')

    <p>&nbsp;</p>

    @include('livewire.preingreso.pdf.intro')

    <p>&nbsp;</p>

    @include('livewire.preingreso.pdf.totales')

    <p>&nbsp;</p>

    @include('livewire.preingreso.pdf.deposito')

    <p>&nbsp;</p>

    @include('livewire.preingreso.pdf.detalle')

    <div class="footer">
        @include('livewire.preingreso.pdf.firma')
        @include('livewire.preingreso.pdf.pie')
    </div>
</body>
</html>