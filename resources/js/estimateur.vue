<script>
    export default {
      data() {
        return {
          pick: 0.22,
          nbMois: 12,
          nbHeures: 35,
          tempsTravail: 1,
          prlvtSource: 1,
          horaireBrut: '',
          mensuelBrut: '',
          annuelBrut: '',
          horaireNet: '',
          mensuelNet: '',
          annuelNet: ''
        }
      },


      methods: {
        NumbersOnly(evt) {
            evt = window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();
            }
            else {
                return true;
            }
        },


// FONCTIONS RESET ON KEYPRESS

        resetInput(donnee){
            this.NumbersOnly(donnee);
            if(this.horaireBrut == donnee) {
                this.horaireNet = "";
                this.mensuelBrut = "";
                this.mensuelNet = "";
                this.annuelBrut = "";
                this.annuelNet = "";
            }
            if(this.mensuelBrut == donnee) {
                this.horaireBrut = "";
                this.horaireNet = "";
                this.mensuelNet = "";
                this.annuelBrut = "";
                this.annuelNet = "";
            }
            if(this.annuelBrut == donnee) {
                this.horaireBrut = "";
                this.horaireNet = "";
                this.mensuelBrut = "";
                this.mensuelNet = "";
                this.annuelNet = "";
            }
            if(this.horaireNet == donnee){
                this.horaireBrut = "";
                this.mensuelBrut = "";
                this.mensuelNet = "";
                this.annuelBrut = "";
                this.annuelNet = "";
            }
            if(this.mensuelNet == donnee){
                this.horaireBrut = "";
                this.horaireNet = "";
                this.mensuelBrut = "";
                this.annuelBrut = "";
                this.annuelNet = "";
            }
            if(this.annuelNet == donnee){
                this.horaireBrut = "";
                this.horaireNet = "";
                this.mensuelBrut = "";
                this.mensuelNet = "";
                this.annuelBrut = "";
            }
            // paye = [this.horaireBrut, this.mensuelBrut, this.annuelBrut, this.horaireNet, this.mensuelNet, this.annuelNet];
            // for(var r = 0, n = paye.length; r < n; r++){
            //     if(donnee !== paye[i]){
            //         this.NumbersOnly(donnee);
            //         paye[r] = "";
            //     }
            //     else{
            //         this.NumbersOnly(donnee);
            //         paye[r] = "";
            //     }
            // }
        },
    },


    computed: {


// FONCTION PRELEVEMENT SOURCE


        prelevSource: function () {
            if(this.mensuelNetResultat < 1440 || this.annuelNetResultat < 1440){
                return (this.prlvtSource);
            }
            else if( this.mensuelNetResultat < 1496 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.005);
            }
            else if( this.mensuelNetResultat < 1592 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.013);
            }
            else if( this.mensuelNetResultat < 1699 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.021);
            }
            else if( this.mensuelNetResultat < 1816 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.029);
            }
            else if( this.mensuelNetResultat < 1913 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.035);
            }
            else if( this.mensuelNetResultat < 2040 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.041);
            }
            else if( this.mensuelNetResultat < 2414 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.053);
            }
            else if( this.mensuelNetResultat < 2763 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.075);
            }
            else if( this.mensuelNetResultat < 3147 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.099);
            }
            else if( this.mensuelNetResultat < 3543 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.119);
            }
            else if( this.mensuelNetResultat < 4134 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.138);
            }
            else if( this.mensuelNetResultat < 4956 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.158);
            }
            else if( this.mensuelNetResultat < 6202 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.179);
            }
            else if( this.mensuelNetResultat < 7747 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.2);
            }
            else if( this.mensuelNetResultat < 10752 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.24);
            }
            else if( this.mensuelNetResultat < 14563 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.28);
            }
            else if( this.mensuelNetResultat < 22860 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.33);
            }
            else if( this.mensuelNetResultat < 48967 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.38);
            }
            else if(this.mensuelNetResultat > 48967 || this.annuelNetResultat < 1440){
                return (this.prlvtSource - 0.43);
            }
        },

// FONCTION NOMBRE HEURES TRAVAILLEES

        nbHeuresTravaillees: function () {
            return (this.nbHeures * 52) / 12;
        },

// FONCTIONS MENSUEL ET ANNUEL NET APRES IMPOTS

        mensuelNetApresImpots: function (){
            if(this.mensuelNetResultat) {
                return parseFloat(this.mensuelNetResultat * this.prelevSource).toFixed(2);
            }
        },
        annuelNetApresImpots: function (){
            if(this.annuelNetResultat){
                return parseFloat(this.annuelNetResultat * this.prelevSource).toFixed(2);
            }
        },


// FONCTIONS ESTIMATEUR SALAIRE BRUT / SALAIRE NET


        horaireBrutResultat: function () {
            if(this.horaireBrut){
                return parseFloat(this.horaireBrut * this.tempsTravail).toFixed(2) ;
            }
            else {
                return ((this.horaireNetResultat / (1 - this.pick))).toFixed(2) ;
            }
        },
        mensuelBrutResultat: function () {
            if(this.mensuelBrut){
            return parseFloat(this.mensuelBrut * this.tempsTravail).toFixed(2);
            }
            else {
                return ((this.horaireBrutResultat * this.nbHeuresTravaillees)).toFixed(2);
            }
        },
        annuelBrutResultat: function () {
            if(this.annuelBrut){
                return parseFloat(this.annuelBrut * this.tempsTravail).toFixed(2);
            }
            else {
                return ((this.mensuelBrutResultat * this.nbMois)).toFixed(2) ;
            }
        },
        annuelNetResultat: function () {
            if(this.annuelNet){
                return parseFloat(this.annuelNet * this.tempsTravail).toFixed(2);
            }
            else {
                return ((this.annuelBrutResultat * (1 - this.pick))).toFixed(2);
            }
        },
        mensuelNetResultat: function () {
            if(this.mensuelNet){
                return parseFloat(this.mensuelNet * this.tempsTravail).toFixed(2);
            }
            else {
                return ((this.annuelNetResultat / this.nbMois)).toFixed(2);
            }
        },
        horaireNetResultat: function () {
            if(this.horaireNet){
                return parseFloat(this.horaireNet * this.tempsTravail).toFixed(2);
            }
            else {
                return ((this.mensuelNetResultat / this.nbHeuresTravaillees)).toFixed(2) ;
            }
        },
    },
}
</script>

<template>
    <div class="container">
        <h3 class="rokett-titre fw-bold text-sm-center">Simulateur salaire brut / salaire net</h3>


        <!-- SALAIRE BRUT / SALAIRE NET -->


        <div class="row col row-cols-1 row-cols-sm-1 row-cols-lg-2 mx-auto py-5 rounded-5">
            <div class="col">
                <label for="horaireBrut" class="form-label rokett-label">Horaire Brut</label>
                <input v-on:keypress="resetInput(horaireBrut)" id="inputBox" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="isNaN(horaireBrutResultat) || horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : horaireBrutResultat" v-model="horaireBrut">

                <label for="mensuelBrut" class="form-label rokett-label mt-3">Mensuel Brut</label>
                <input v-on:keypress="resetInput(mensuelBrut)" id="inputBox" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="isNaN(mensuelBrutResultat) || horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : mensuelBrutResultat" v-model="mensuelBrut">

                <label for="annuelBrut" class="form-label rokett-label mt-3">Annuel Brut</label>
                <input v-on:keypress="resetInput(annuelBrut)" id="inputBox" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="isNaN(annuelBrutResultat) || horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : annuelBrutResultat" v-model="annuelBrut">
            </div>
            <div class="col">
                <label for="horaireNet" class="form-label rokett-label">Horaire Net</label>
                <input v-on:keypress="resetInput(horaireNet)" id="inputBox" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="isNaN(horaireNetResultat) || horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : horaireNetResultat" v-model="horaireNet">

                <label for="mensuelNet" class="form-label rokett-label mt-3">Mensuel Net</label>
                <input v-on:keypress="resetInput(mensuelNet)" id="inputBox" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="isNaN(mensuelNetResultat) || horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : mensuelNetResultat" v-model="mensuelNet">

                <label for="annuelNet" class="form-label rokett-label mt-3">Annuel Net</label>
                <input v-on:keypress="resetInput(annuelNet)" id="inputBox" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="isNaN(annuelNetResultat) || horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : annuelNetResultat" v-model="annuelNet">
            </div>
        </div>
        <div class="container">
            <div class="row col col-sm">


                <!-- SELECTION STATUT -->


                <div class="d-grid col justify-content-sm-center text-sm-center">
                    <div class="row justify-content-center">
                        <label class="form-label rokett-label">Sélectionnez votre statut :</label>
                        <input v-model.number="pick" v-bind:value="0.22" class="btn-check" type="radio" name="inlineRadioOptions" id="noncadre" checked>
                        <label class="btn rokett-box mx-auto" for="noncadre">Salarié non-cadre</label>

                        <input v-model.number="pick" v-bind:value="0.25" class="btn-check" type="radio" name="inlineRadioOptions" id="cadre">
                        <label class="btn rokett-box mx-auto" for="cadre">Salarié cadre</label>
                    </div>

                    <div class="row justify-content-center pt-sm-2">
                        <input v-model.number="pick" v-bind:value="0.45" class="btn-check" type="radio" name="inlineRadioOptions" id="professionLiberale">
                        <label class="btn rokett-box mx-auto" for="professionLiberale">Profession libérale</label>

                        <input v-model.number="pick" v-bind:value="0.51" class="btn-check" type="radio" name="inlineRadioOptions" id="portageSalarial">
                        <label class="btn rokett-box mx-auto" for="portageSalarial">Portage salarial</label>
                    </div>
                </div>


                <!-- SELECTION NOMBRE MOIS  && HEBDOMADAIRES && TEMPS DE TRAVAIL-->


                <div class="col-lg-5 col-sm-12">
                    <label for="nbMois" class="form-label rokett-label pt-sm-2">Sélectionnez le nombre de mois</label>
                    <div class="radio-group">
                        <input v-model.number="nbMois" class="rokett-input-mois" v-bind:value="12" type="radio" name="nbMois" id="nbMois12" checked>
                        <label class="rokett-label-mois" for="nbMois12">12</label>

                        <input v-model.number="nbMois" class="rokett-input-mois" v-bind:value="13" type="radio" name="nbMois" id="nbMois13">
                        <label class="rokett-label-mois" for="nbMois13">13</label>

                        <input v-model.number="nbMois" class="rokett-input-mois" v-bind:value="14" type="radio" name="nbMois" id="nbMois14">
                        <label class="rokett-label-mois" for="nbMois14">14</label>

                        <input v-model.number="nbMois" class="rokett-input-mois" v-bind:value="15" type="radio" name="nbMois" id="nbMois15">
                        <label class="rokett-label-mois" for="nbMois15">15</label>
                    </div>
                    <label for="nbHeures" class="form-label rokett-label mt-3">Nombre d'heures hebodmadaires</label>
                    <input v-model.number="nbHeures" type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" placeholder="Exemple : 35 heures">
                    <label for="tpsTravail" class="form-label rokett-label mt-3">Temps de Travail : {{ parseInt(this.tempsTravail * 100) }}%</label>
                    <input v-model.number="tempsTravail" type="range" class="rokett-input-range" id="tpsTravail" min="0.1" max="1" step="0.1">
                </div>


                <!-- PRELEVEMENT A LA SOURCE -->


                <div class="col-lg-4 col-sm-12">
                    <label class="form-label rokett-label" for="MNAI">Mensuel Net Après Impôt</label>
                    <input disabled type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : mensuelNetApresImpots">
                    <label class="form-label rokett-label mt-3" for="ANAI">Annuel Net Après Impôt</label>
                    <input disabled type="number" class="form-control rokett-bg-input rokett-no-border rokett-nombre" :placeholder="horaireBrut == '' && mensuelBrut == '' && annuelBrut == '' && horaireNet == '' && mensuelNet == '' && annuelNet == '' ? '0.00' : mensuelNetApresImpots">
                    <label for="prelevSource" class="form-label rokett-label mt-3">Taux de prélèvement à la source : {{ isNaN(this.prelevSource) ? '0' : Math.round((1 - this.prelevSource) * 100) }}%</label>
                </div>
            </div>
        </div>
    </div>
</template>
