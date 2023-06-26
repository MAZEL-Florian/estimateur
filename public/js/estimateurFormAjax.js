// FONCTION SELECTIONNER VILLE ET EXPERIENCE

function selectVilleXp() {
    let villeContainer = $('#ville-container');
    villeContainer.empty();
    let xpContainer = $('#xp-container');
    xpContainer.empty();
    $.ajax({
        type: 'GET',
        url: '/villes/',
        success: function(villes) {
            var villesContainer = $('<div class="text-center"></div>');
            var select = $('<select class="ville-select form-select form-select-lg estimateur-select mb-3" name="ville_id" id="ville"><option value="none" selected disabled hidden>Ville</option></select>');
                villes.forEach(function(ville) {
                    let villeId = ville.id;
                    select.append(
                        $('<option value="' + villeId + '">' + ville.nom + '</option>')
                    );
                });
                villesContainer.append(select);
                villeContainer.append(villesContainer);
                villeContainer.append('</select>');
                villeContainer.slideDown();
        }
    })
    let className = "square btn-check";
    var xpContainers = $('<div class="text-center"></div>');
    xpContainers.append(
        $('<div class="text-center">'),
        ('<input class="' + className +'" type="radio" name="xp_id" id="xp1" data-xp-id="1" value="1"></input>' +
        ' <label class="rokett-box-estimateur mx-auto" for="xp1">Junior</label>'),
        ('<input class="' + className +'" type="radio" name="xp_id" id="xp2" data-xp-id="2" value="2"></input>' +
        ' <label class="rokett-box-estimateur mx-auto" for="xp2">Confirmé</label>'),
        ('<input class="' + className +'" type="radio" name="xp_id" id="xp3" data-xp-id="3" value="3"></input>' +
        ' <label class="rokett-box-estimateur mx-auto" for="xp3">Senior</label>'),
        ('</div>'),
    );
    xpContainer.append(xpContainers);
    xpContainer.append($('</div>'));
    xpContainer.slideDown();
    $(document).ready(function() {
        $(".submit-form").prop("disabled", true);
        $(document).on("change", "#ville, input[name=xp_id]", function() {
          if ($("#ville").val() != null && $("input[name=xp_id]:checked").val() != undefined) {
            $(".submit-form").prop("disabled", false);
          } else {
            $(".submit-form").prop("disabled", true);
          }
        });
      });
}

// RECUPERATION DE LA VALEUR DU SECTEUR PUIS AFFICHAGE DES METIERS CORRSPONDANTS

$(".secteur-select").change(function() {
    let secteurId = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/metiers/' + secteurId,
        success: function(metiers) {
            let metierContainer = $('#metier-container');
            metierContainer.empty();
            if (metiers.length > 0) {
                var metiersContainer = $('<div class="text-center"></div>');
                var select = $('<select class="metier-select form-select form-select-lg estimateur-select mb-3" name="metier_id" id="metier"><option value="none" selected disabled hidden>Métier</option></select>');
                metiers.forEach(function(metier) {
                    let metierId = metier.id;
                    select.append(
                    $('<option value="' + metierId + '">' + metier.nom + '</option>')
                    );
                });
                metiersContainer.append(select);
                metierContainer.append(metiersContainer);
                metierContainer.append('</select>');
                metierContainer.slideDown();
                $("#stack-container").empty().hide();
                $("#specialisation-container").empty().hide();
                $("#framework-container").empty().hide();
                $("#xp-container").empty().hide();
                $("#ville-container").empty().hide();
                $(".submit-form").prop("disabled", true);
            }
            else
            {
                selectVilleXp();
                metierContainer.hide();
            }
        }
    });
});

// RECUPERATION DE LA VALEUR DU METIER PUIS AFFICHAGE DES STACKS CORRSPONDANTS

$("#metier-container").on("change", ".metier-select", function() {
    let metierId = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/stacks/' + metierId,
        success: function(stacks) {
            let stackContainer = $('#stack-container');
            stackContainer.empty();
            if (stacks.length > 0) {
                var stacksContainer = $('<div class="text-center"></div>');
                var select = $('<select class="stack-select form-select form-select-lg estimateur-select mb-3" name="stack_id" id="stack"><option value="none" selected disabled hidden>Stack</option></select>');
                stacks.forEach(function(stack) {
                    let stackId = stack.id;
                    select.append(
                    $('<option value="' + stackId + '">' + stack.nom + '</option>')
                    );
                });
                stacksContainer.append(select);
                stackContainer.append(stacksContainer);
                stackContainer.append('</select>');
                stackContainer.slideDown();
                $("#specialisation-container").empty().hide();
                $("#framework-container").empty().hide();
                $("#xp-container").empty().hide();
                $("#ville-container").empty().hide();
                $(".submit-form").prop("disabled", true);
            }
            else
            {
                selectVilleXp();
                stackContainer.hide();
            }
        }
    });
});

// RECUPERATION DE LA VALEUR DU STACK PUIS AFFICHAGE DES SPECIALISATIONS CORRSPONDANTS

$("#stack-container").on("change", ".stack-select", function() {
    let stackId = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/specialisations/' + stackId,
        success: function(specialisations) {
            let specialisationContainer = $('#specialisation-container');
            specialisationContainer.empty();
            if (specialisations.length > 0) {
                var specialisationsContainer = $('<div class="text-center"></div>');
                var select = $('<select class="specialisation-select form-select form-select-lg estimateur-select mb-3" name="specialisation_id" id="specialisation"><option value="none" selected disabled hidden>Spécialisation</option></select>');
                specialisations.forEach(function(specialisation) {
                    let specialisationId = specialisation.id;
                    select.append(
                    $('<option value="' + specialisationId + '">' + specialisation.nom + '</option>')
                    );
                });
                specialisationsContainer.append(select);
                specialisationContainer.append(specialisationsContainer);
                specialisationContainer.append('</select>');
                specialisationContainer.slideDown();
                $("#framework-container").empty().hide();
                $("#xp-container").empty().hide();
                $("#ville-container").empty().hide();
                $(".submit-form").prop("disabled", true);
            }
            else
            {
                selectVilleXp();
                specialisationContainer.hide();
            }
        }
    });
});

// RECUPERATION DE LA VALEUR DE LA SPECIALISATION PUIS AFFICHAGE DES FRAMEWORKS CORRSPONDANTS

$("#specialisation-container").on("change", ".specialisation-select", function() {
    let stackId =  $('select[name="stack_id"]').val();
    let specialisationId = $(this).val();
    $.ajax({
        type: 'GET',
        url: "/frameworks/" + specialisationId + "/" + stackId,
        success: function(frameworks) {
            let frameworkContainer = $('#framework-container');
            frameworkContainer.empty();
            if (frameworks.length > 0) {
                var frameworksContainer = $('<div class="text-center"></div>');
                var select = $('<select class="framework-select form-select form-select-lg estimateur-select mb-3" name="framework_id" id="framework"><option value="none" selected disabled hidden>Framework</option></select>');
                frameworks.forEach(function(framework) {
                    let frameworkId = framework.id;
                    select.append(
                    $('<option value="' + frameworkId + '">' + framework.nom + '</option>')
                    );
                });
                frameworksContainer.append(select);
                frameworkContainer.append(frameworksContainer);
                frameworkContainer.append('</select>');
                frameworkContainer.slideDown();
            }
            else
            {
                selectVilleXp();
                frameworkContainer.hide();
            }
        }
    });

});

// RECUPERATION DE LA VALEUR DU FRAMEWORK PUIS APPEL DE LA FONCTION POUR SELECTIONNER LA VILLE ET L'XP

$("#framework-container").on("change", ".framework-select", function() {
    if ($(this).val() !== null) {
        selectVilleXp();
    }
  });

// VALIDATION DES DONNEES

$('.submit-form').click(function(e) {
    e.preventDefault();
    let secteurId = $('select[name="secteur_id"]').val();
    let metierId = $('select[name="metier_id"]').val();
    let stackId = $('select[name="stack_id"]').val();
    let specialisationId = $('select[name="specialisation_id"]').val();
    let frameworkId = $('select[name="framework_id"]').val();
    let xpId =$('input[name="xp_id"]:checked').val();
    let villeId = $("#ville").val();

    if(typeof secteurId === "undefined"){
        secteurId = null;
    }
    if(typeof metierId === "undefined"){
        metierId = null;
    }
    if(typeof stackId === "undefined"){
        stackId = null;
    }
    if(typeof specialisationId === "undefined"){
        specialisationId = null;
    }
    if(typeof frameworkId === "undefined"){
        frameworkId = null;
    }
    $.ajax({
        type: 'GET',
        url: "/form",
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        data: {
            secteur: secteurId,
            metier: metierId,
            stack: stackId,
            specialisation: specialisationId,
            framework: frameworkId,
            xp: xpId,
            ville: villeId
        },
        success: function(data) {
            if(data.moyenne === undefined){
                console.error("Erreur : La valeur moyenne n'a pas été retournée correctement");
            }
            else
            {
                let result = $('#result');
                result.fadeOut(function() {
                    result.empty();
                    result.append('Votre salaire est estimé à : ' + data.moyenne + '€.');
                    result.fadeIn();
                });

                let job = $('#secteur');
                job.fadeOut(function() {
                    job.empty();
                var jobs = $('<div class="text-center"></div>');
                jobs.append('<span>' + data.secteur + '</span>');
                if(data.metier !== null){
                    var resSecteur = $('<span> - ' + data.metier + '</span>');
                    jobs.append(resSecteur);
                }
                else{
                    var resSecteur = $('');
                    jobs.append(resSecteur);
                }
                if(data.stack != null){
                    var resStack = $('<span> - ' + data.stack + '</span>');
                    jobs.append(resStack);
                }
                else{
                    var resStack = $('');
                    jobs.append(resStack);
                }
                if(data.specialisation != null){
                    var resSpecialisation = $('<span> - ' + data.specialisation + '</span>');
                    jobs.append(resSpecialisation);
                }
                else{
                    var resSpecialisation = $('');
                    jobs.append(resSpecialisation);
                }
                if(data.framework != null){
                    var resFramework = $('<span> - ' + data.framework + '</span>');
                    jobs.append(resFramework);
                }
                else{
                    var resFramework = $('');
                    jobs.append(resFramework);
                }
                job.append(jobs);
                job.append($('</p> </div>'));
                job.fadeIn();
            });
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});
