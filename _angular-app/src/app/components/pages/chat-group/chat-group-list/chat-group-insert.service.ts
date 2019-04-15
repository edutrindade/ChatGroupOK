import {Injectable} from "@angular/core";
import {HttpErrorResponse} from "@angular/common/http";
import {NotifyMessageService} from "../../../../services/notify-message.service";
import {ChatGroupListComponent} from "./chat-group-list.component";

@Injectable({
    providedIn: 'root'
})

export class ChatGroupInsertService{

    private _chatGroupListComponent: ChatGroupListComponent;

    constructor(private notifyMessage: NotifyMessageService){

    }

    set chatGroupListComponent(value: ChatGroupListComponent){
        this._chatGroupListComponent = value;
    }
    
    showModalInsert(){
        this._chatGroupListComponent.chatGroupNewModal.showModal();
    }

    onInsertError($event: HttpErrorResponse) {
        console.log($event);
    }

    onInsertSucess($event: any) {
        this.notifyMessage.success('Grupo cadastrado com sucesso!');
        this._chatGroupListComponent.getChatGroups();
    }
}