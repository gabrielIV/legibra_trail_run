
if(!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))) {
 // some code..
TweenMax.to("#mountain",120,{x:"-50%",repeat﻿:-﻿﻿﻿﻿1,ease: Power0.easeNone});
TweenMax.to("#gold",120,{x:"-50%",repeat﻿:-﻿﻿﻿﻿1,ease: Power0.easeNone});
TweenMax.to("#ground",20,{x:"-50%",repeat﻿:-﻿﻿﻿﻿1,ease: Power0.easeNone});

TweenMax.to("#shine",2,{x:($(window).width()*1.25)+"px",repeat﻿:-﻿﻿﻿﻿1,repeatDelay:4,ease: Power0.easeNone});
}
