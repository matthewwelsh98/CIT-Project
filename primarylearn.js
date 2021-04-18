


//DOM references
const canvas = document.getElementById('myCanvas')
const ctx = canvas.getContext('2d')
const shuffleBtn = document.getElementById('shuffle-btn')
const resetBtn = document.getElementById('reset-btn')
const newGameBtn = document.getElementById('newGame-btn')

const count = 15
//Alphabet scores based off Scrabble
const alphabet = [
  {letter:'A',value:1},
  {letter:'B',value:3},
  {letter:'C',value:3},
  {letter:'D',value:2},
  {letter:'E',value:1},
  {letter:'F',value:4},
  {letter:'G',value:2},
  {letter:'H',value:4},
  {letter:'I',value:1},
  {letter:'J',value:8},
  {letter:'K',value:5},
  {letter:'L',value:1},
  {letter:'M',value:3},
  {letter:'N',value:1},
  {letter:'O',value:1},
  {letter:'P',value:3},
  {letter:'Q',value:10},
  {letter:'R',value:1},
  {letter:'S',value:1},
  {letter:'T',value:1},
  {letter:'U',value:1},
  {letter:'V',value:4},
  {letter:'W',value:4},
  {letter:'X',value:8},
  {letter:'Y',value:4},
  {letter:'Z',value:10},
]
var scrabbleAlphabet
const tileSize = 25
const padding = tileSize + 5
const startingX = (canvas.width - (count-1)*padding)/2
const startingY = canvas.height - 40

const letter = {value:'', x:0, y:0, width:tileSize, height:tileSize, inBoundsOf: inBoundsOf, center: center, letterMultiplier: 1, wordMultiplier: 1}
const word = {value:'',score:0, x:5, y:0, width:canvas.width-10,height:60, letters:null, insert:insert}

var letters
var activeLetter
var word1
var word2
var wordbank

//Drawing functions
function drawLetter(x,y,letter){
  ctx.beginPath()
  if(letter.letterMultiplier > 1 || letter.wordMultiplier > 1)
    ctx.rect(x,y-4,letter.width,letter.height+4)
  else
    ctx.rect(x,y,letter.width,letter.height)
  ctx.strokeStyle = 'black'
  ctx.stroke()
  ctx.closePath()
  
  ctx.font = "16px Arial"
  ctx.fillStyle = 'black'
  ctx.textAlign = "center"
  ctx.fillText(letter.value,x+letter.width/2,y+letter.height*3/4)
  
  ctx.font = "8px Arial"
  ctx.fillStyle = 'black'
  ctx.textAlign = "right"
  ctx.fillText(letter.score,x+letter.width-2,y+letter.height-2)
  
  if(letter.letterMultiplier > 1){
    ctx.font = "8px Arial"
    ctx.fillStyle = 'black'
    ctx.textAlign = "center"
    ctx.fillText(letter.letterMultiplier+'L',x+letter.width/2-1,y+4)
  }
  else if(letter.wordMultiplier > 1){
    ctx.font = "8px Arial"
    ctx.fillStyle = 'black'
    ctx.textAlign = "center"
    ctx.fillText(letter.wordMultiplier+'W',x+letter.width/2-1,y+4)
  }
}
function drawWord(w, score=false){
  ctx.beginPath()
  ctx.rect(w.x,w.y,w.width,w.height)
  ctx.strokeStyle = 'black'
  ctx.stroke()
  ctx.closePath()
  
  if(score){
    ctx.font = "16px Arial"
    ctx.fontStyle = 'black'
    ctx.textAlign = 'center'
    ctx.fillText(w.score,w.x+w.width/2,w.y+w.height+20)
  }
}
function drawTotalScore(){
  // let total = 0
  let total = word1.score + word2.score
  ctx.font = "16px Arial"
  ctx.fontStyle = 'black'
  ctx.textAlign = 'center'
  ctx.fillText('Total '+total,canvas.width/2,15)
}
function drawGUI(){
  drawTotalScore()
  drawWord(word1,true)
  drawWord(word2,true)
  drawWord(wordbank)
}

//Canvas drawing function
function draw(){
  ctx.clearRect(0,0,canvas.width,canvas.height)
  drawGUI()
  letters.forEach((l,i)=>drawLetter(l.x, l.y, l))
  requestAnimationFrame(draw)
}

//Helper
function inBoundsOf(object){
  if(this.center().x > object.x && 
     this.center().x < object.x+object.width && 
     this.center().y > object.y && 
     this.center().y < object.y+object.height){
    return true
  }
  else{
    return false
  }
}
function center(){
  return {
    x: this.x + this.width/2,
    y: this.y + this.height/2
  }
}
function wordSnapping(w){
  let length = w.letters.length
  let start = w.x + (w.width-length*padding)/2
  w.letters.forEach((l,i)=>{
    l.x = start + i * padding
    l.y = w.y + w.height/2 - l.height/2
  })
}
function insert(l){
  let insert = false
      for(let i=0; i<this.letters.length; i++){
        //insert before letter if it is to the left of it
        if(this.letters[i].center().x > l.center().x){
          this.letters.splice(i,0,l)
          insert = true
          break
        }
      }
      if(!insert){
       this.letters.push(l) 
      }
}
function updateWord(w){
  let word = w.letters.map(l=>l.value).join('')
  let sum = 0
  let wordMultiplier = 0
  if(word){
    if(Word_List.isInList(word)){
      for(let l of w.letters){
        sum += l.score * l.letterMultiplier
        if(l.wordMultiplier > 1){
          wordMultiplier += l.wordMultiplier
        }
      }
    }
  }
  wordMultiplier = wordMultiplier || 1
  w.score = sum * wordMultiplier
} 

//Events
function mouseDownHandler(e){
  let rect = canvas.getBoundingClientRect()
  let x = e.clientX - rect.left
  let y = e.clientY - rect.top 
  
  letters.forEach(l=>{
    if(x>l.x&&x<l.x+tileSize && y>l.y && y<l.y+tileSize){
      activeLetter = l
      let word1Index = word1.letters.indexOf(activeLetter)
      let word2Index = word2.letters.indexOf(activeLetter)
      let wordbankIndex = wordbank.letters.indexOf(activeLetter)
      if(word1Index != -1){
        word1.letters.splice(word1Index,1)
        
      }
      else if(word2Index != -1){
        word2.letters.splice(word2Index,1)
      }
      else if(wordbankIndex != -1){
        wordbank.letters.splice(wordbankIndex,1)
      }
    }
  })
}
function mouseUpHandler(e){
  if(activeLetter){
    if(activeLetter.inBoundsOf(word1)){
      word1.insert(activeLetter)
    }
    else if(activeLetter.inBoundsOf(word2)){
      word2.insert(activeLetter)
    }
    // else if(activeLetter.inBoundsOf(wordbank)){
    else{
      wordbank.insert(activeLetter)
    }
    
    //Snapping
    wordSnapping(word1)
    wordSnapping(word2)
    wordSnapping(wordbank)
    
    updateWord(word1)
    updateWord(word2)

    activeLetter = null 
  }
}
function mouseMoveHandler(e){
  if(activeLetter){
    let rect = canvas.getBoundingClientRect()
    let x = e.clientX - rect.left
    let y = e.clientY - rect.top

    activeLetter.x = x 
    activeLetter.y = y
  }
}
function shuffle(){
  for (let i = wordbank.letters.length; i; i--) {
    let j = Math.floor(Math.random() * i);
    [wordbank.letters[i - 1], wordbank.letters[j]] = [wordbank.letters[j], wordbank.letters[i - 1]];
  }
  wordSnapping(wordbank)
}
function reset(){
  word1.letters= []
  word2.letters=[]
  updateWord(word1)
  updateWord(word2)
  
  wordbank.letters=[]
  letters.forEach(l=>wordbank.letters.push(l))
  
  wordSnapping(wordbank)
}
function newGame(){
  letters = []
  activeLetter = null
  
  scrabbleAlphabet = []
  for(let i=0; i<alphabet.length; i++){
    let letterCount = 0
    switch(i){
      case 0:
      case 8:{
        letterCount = 9
        break
      }
      case 1:
      case 2:
      case 5:
      case 7:
      case 12:
      case 15:
      case 21:
      case 22:
      case 24:{
        letterCount = 2
        break
      }
      case 3:
      case 11:
      case 18:
      case 20:{
        letterCount = 4
        break
      }
      case 4:{
        letterCount = 12
        break
      }
      case 6:{
        letterCount = 3
        break
      }
      case 9:
      case 10:
      case 16:
      case 23:
      case 25:{
        letterCount = 1
        break
      }
      case 13:
      case 17:
      case 19:{
        letterCount = 6
        break
      }
      case 14:{
        letterCount = 8
        break
      }
    }
    let arr = Array(letterCount).fill(alphabet[i])
    scrabbleAlphabet = [...scrabbleAlphabet, ...arr]
  }
  console.log(scrabbleAlphabet.length)

  for(let i=0; i<count; i++){
    var x = startingX + i*padding
    var y = startingY
    let index = Math.floor(Math.random() * scrabbleAlphabet.length)
    let l = scrabbleAlphabet[index]
    scrabbleAlphabet.splice(index,1)
    let newLetter = Object.assign(
      {},
      letter,
      {
        value: l.letter,
        score: l.value,
        x: x,
        y: y
      })
    //get rate
    let multiplier = getMultiplier()
    //if rate over 1 then pick type
    if(multiplier > 1){
      let type = getMultiplierType()
      newLetter[type] = multiplier
    }
    letters.push(newLetter)
  }
  function getMultiplier(){
    let rand = Math.random()
    if(rand < .05)
      return 6
    else if(rand < .1)
      return 5
    else if(rand < .15)
      return 4
    else if(rand < .2)
      return 3
    else if(rand < .3)
      return 2
    else
      return 1
  }
  function getMultiplierType(){
    let rand = Math.random()
    if(rand < 0.3)
      return 'wordMultiplier'
    else
      return 'letterMultiplier'
  }

  word1 = Object.assign({},word,{y:20, letters:[]})
  word2 = Object.assign({},word,{y:120, letters:[]})
  wordbank = Object.assign({},word,{y:canvas.height-65, letters:[...letters]})
  wordSnapping(wordbank)
}

//Listeners
document.addEventListener("mousedown",mouseDownHandler,false)
document.addEventListener("mouseup",mouseUpHandler,false)
document.addEventListener("mousemove",mouseMoveHandler,false)
shuffleBtn.addEventListener("click",shuffle,false)
resetBtn.addEventListener("click",reset,false)
newGameBtn.addEventListener("click",newGame,false)

//Init the game
newGame()

//Start the canvas drawing function
draw()
