import { ref, SetupContext } from 'vue'

const refMessage = ref<string>('')

let presses: { [key: string]: boolean } = {}

function resetKeyLog () {
      presses = {}
}
function onKeyDown (event: KeyboardEvent) {
  presses[event.key] = true;
}

function setupOnkeyUp(limit: number, ctx: SetupContext<string[]>): () => void {
    return () => {
      const enteredKey = 'Enter'
      const shiftKey = 'Shift';
      if (presses[enteredKey] && !presses[shiftKey]) {
        const messageToSend = refMessage.value.trim()
        refMessage.value = ''
        resetKeyLog()
        ctx.emit('updateValue', messageToSend)
      } else  {
        const msg = refMessage.value.trim()
        if (msg.length > limit) {
          refMessage.value = msg.substring(0, limit)
        }
        resetKeyLog()
      }
    }
}

export const emits = [
  'updateValue'
]

export function useInputBox(limit: number, ctx: SetupContext<string[]>) {
  return {
    refMessage,
    onKeyUp: setupOnkeyUp(limit, ctx),
    onKeyDown
  }
}
