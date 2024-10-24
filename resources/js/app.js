import './bootstrap';
import "/node_modules/select2/dist/css/select2.css";
import $ from 'jquery';


$('#currencyselect').select2({
    maximumSelectionLength: 5,
    minimumSelectionLength: 1,
    minimumInputLength: 1, // Minimum characters before results are displayed
    placeholder: 'Select an option',
    allowClear: true
});


    // Form submission event
    $('#currency_form').on('submit', function(event) {

        event.preventDefault(); // Prevent default submission
        $('#errorMessage').text('').hide();
        $('#successMessage').text('').hide();


        const options = $('#currencyselect').val(); // Get selected options
        let hasError = false;

        if (!options || options.length === 0) {
            $('#errorMessage').text('At least one option must be selected.').show();
            hasError = true;
        }

        // If no errors, display success message
        if (!hasError) {
            const formData = {
                currencyselect: options
            };

            $.ajax({
                type: 'POST',
                url: '/set-user-currency', // Replace with your API endpoint
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {

                    $('#currencytable').empty();
                     // Create a table element
                     let table = $('<table class="table table-bordered table-striped"></table>');
                     let thead = $('<thead></thead>');
                     let tbody = $('<tbody></tbody>');

                     // Create header row
                     let headerRow = $('<tr></tr>');
                     headerRow.append('<th>Currency</th>');
                     headerRow.append('<th>Source</th>');
                     headerRow.append('<th>Conversion</th>');
                     thead.append(headerRow);

                    //response
                    response.data.quotes.forEach(function(item) {
                        let row = $('<tr></tr>');
                        row.append('<td>' + item.currency + '</td>');
                        row.append('<td>' + item.source + '</td>');
                        row.append('<td>' + item.quote + '</td>');
                        tbody.append(row);
                    });

                    // Append thead and tbody to the table
                    table.append(thead);
                    table.append(tbody);

                    // Clear previous results and append the new table
                    $('#currencytable').empty().append(table);
                    $('#successMessage').text('Currency collected successfully!').show();
                },
                error: function(xhr) {
                    // Handle errors
                    $('#errorMessage').text('An error occurred. Please try again.').show();
                }
            });
        }
    });
        // Clear previous error messages

        $('#reportcurrencyselect').select2({
            placeholder: 'Select an option',
            allowClear: true
        });


            // Form submission event
    $('#user_report_form').on('submit', function(event) {

        event.preventDefault(); // Prevent default submission
        $('#errorMessage').text('').hide();
        $('#successMessage').text('').hide();


        const options = $('#reportcurrencyselect').val(); // Get selected options
        let hasError = false;

        if (!options || options.length === 0) {
            $('#errorMessage').text('Select One Currency.').show();
            hasError = true;
        }

        const rangeoptions = $('#rangeinterval').val(); // Get selected options
        if (!rangeoptions || rangeoptions.length === 0) {
            $('#errorMessage').text('Select Range-Interval.').show();
            hasError = true;
        }

        const source = $('#reportsource').val();

        if(source == ""  || source == null || source == NaN){
            $('#errorMessage').text('Enter Source.').show();
            hasError = true;
        }

        // If no errors, display success message
        if (!hasError) {
            const formData = {
                currencyselect: options,
                rangeinterval: rangeoptions,
                source: source
            };

            $.ajax({
                type: 'POST',
                url: '/set-user-report-request', // Replace with your API endpoint
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {

                    $('#rangeinterval').trigger('reset');
                    $('#successMessage').text('Currency Report collected successfully!').show();

                    setTimeout(function(){
                        console.log('settimeout');
                        window.location.reload();
                    },1000);

                },
                error: function(xhr) {
                    // Handle errors
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.message;
                        // Display the first error for each field
                        $('#errorMessage').text(errors).show();
                    }else{
                        $('#errorMessage').text('An error occurred. Please try again.').show();
                    }

                }
            });
        }
    });


