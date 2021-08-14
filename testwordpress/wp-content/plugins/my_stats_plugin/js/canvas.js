let allVisiteurs = document.getElementById('allVisiteurs').value;
let yearVisiteurs = document.getElementById('yearVisiteurs').value;
let monthVisiteurs = document.getElementById('monthVisiteurs').value;
let weekVisiteurs = document.getElementById('weekVisiteurs').value;
let onedayVisiteurs = document.getElementById('onedayVisiteurs').value;
let ctx = document.getElementById('myChart').getContext('2d');


let allQuiz = document.getElementById('allQuiz').value;
let yearQuiz  = document.getElementById('yearQuiz').value;
let monthQuiz = document.getElementById('monthQuiz').value;
let weekQuiz = document.getElementById('weekQuiz').value;
let onedayQuiz  = document.getElementById('onedayQuiz').value;
let ctxtwo = document.getElementById('myChartnumberquizz').getContext('2d');



let chart_visiteurs = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['all_visiteurs', 'visiteurs/year', 'visiteurs/month', 'visiteurs/week', 'visiteurs/-24H'],
        datasets: [{
            label: '# of Votes',
            data: [allVisiteurs, yearVisiteurs, monthVisiteurs, weekVisiteurs, onedayVisiteurs],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});





let chart_quiz = new Chart(ctxtwo, {
    type: 'bar',
    data: {
        labels: ['all_quiz', 'quiz/year', 'quiz/month', 'quiz/week', 'quiz/-24H'],
        datasets: [{
            label: '# of Votes',
            data: [allQuiz, yearQuiz, monthQuiz, weekQuiz, onedayQuiz],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
