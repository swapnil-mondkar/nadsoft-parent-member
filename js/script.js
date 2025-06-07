$('#addMemberForm').on('submit', function (e) {
    e.preventDefault();

    const Name = $('#nameField').val().trim();
    const ParentId = $('#parentSelect').val();

    if (!/^[a-zA-Z\s]+$/.test(Name)) {
        return alert("Name must only contain letters and spaces.");
    }

    $.post('insert.php', { Name, ParentId }, function (response) {
        let data;
        try {
            data = JSON.parse(response);
        } catch (e) {
            return alert("Invalid response from server.");
        }

        if (!data.success) return alert(data.message || 'Something went wrong');

        $.get('get_tree.php', function (html) {
            $('#memberTree').html(html);
        });

        $.getJSON('get_members.php', function (members) {
            let options = '<option value="">-- No Parent --</option>';
            members.forEach(m => {
                options += `<option value="${m.Id}">${m.Name}</option>`;
            });
            $('#parentSelect').html(options);
        });

        $('#addMemberForm')[0].reset();
        Fancybox.close();
    });
});
