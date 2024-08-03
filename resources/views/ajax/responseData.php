<div class="container">
    <div class="row d-flex justify-content-center">
        <!--Grid column-->

        <div class="col-md-4 mb-4">
            <h3>اختر وسيله الدفع المناسبه</h3>
            <div id="showPayForm">
                <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $responseData['id'] }}"></script>
                <form action="{{ route('single_invoices') }}" class="paymentWidgets" data-brands="VISA MASTER MADA"></form>
            </div>


            @if (isset($success))
                <div class="alert alert-success text-center">
                    تم الدفع بنجاح
                </div>
            @endif


            @if (isset($fail))
                <div class="alert alert-danger text-center">
                    فشلت عملية الدفع
                </div>
            @endif

        </div>

    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).on('click', '#submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: "{{ route('get_checkout_id', ['subtotal' => $subtotal]) }}",
            data: {
                subtotal: $('#subtotal').text(),
            },
            success: function(data) {
                if (data.status == true) {

                    $('#showPayForm').empty().html(data.content);

                } else {}
            },
            error: function(reject) {}
        });
    });
</script>
@stop
