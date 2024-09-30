function update(What,dataname,type,inputT = "text",Step = "1"){
    Swal.fire({
        title: "Vul hier een nieuwe "+What+" in",
        input: inputT,
        inputAttributes: {
          autocapitalize: "off",
          step: Step
        },
        showCancelButton: true,
        confirmButtonText: "Opslaan",
        confirmButtonColor: "#bd7536",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        console.log(result.value);
        // window.location = "monster.php?monsterUpdate"+dataname+"="+result.value+"&"+window.location.search.replace( '?', '');
        window.location = "monster.php?monsterUpdate="+result.value+"&"+window.location.search.replace( '?', '')+"&what="+dataname+"&type="+type;
      });
}